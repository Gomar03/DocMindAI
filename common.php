<?php
/**
 * Common functions for medical AI applications
 * 
 * Contains shared functionality used across different medical analysis tools
 * 
 * @author Costin Stroie <costinstroie@eridu.eu.org>
 * @version 1.0
 * @license GPL 3
 */

/**
 * Get the color associated with a severity level
 * 
 * @param int $severity Severity level (0-10)
 * @return string Hex color code
 */
function getSeverityColor($severity) {
    if ($severity == 0) return '#10b981'; // green
    if ($severity <= 3) return '#3b82f6'; // blue
    if ($severity <= 6) return '#f59e0b'; // orange
    return '#ef4444'; // red
}

/**
 * Get the label associated with a severity level
 * 
 * @param int $severity Severity level (0-10)
 * @return string Severity label
 */
function getSeverityLabel($severity) {
    if ($severity == 0) return 'Normal';
    if ($severity <= 3) return 'Minor';
    if ($severity <= 6) return 'Moderate';
    if ($severity <= 8) return 'Severe';
    return 'Critic';
}

/**
 * Format file size in human readable format
 * 
 * @param int $bytes File size in bytes
 * @return string Human readable file size
 */
function formatFileSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, 2) . ' ' . $units[$pow];
}

/**
 * Preprocess image for better OCR results
 * Enhances contrast, applies threshold, and resizes image
 * 
 * @param string $image_path Path to the original image
 * @return string|false Path to preprocessed image or false on error
 */
function preprocessImageForOCR($image_path) {
    // Create temporary file path
    $temp_path = tempnam(sys_get_temp_dir(), 'ocr_') . '.png';
    
    // Get image info
    $image_info = getimagesize($image_path);
    if ($image_info === false) {
        return false;
    }
    
    // Create image resource based on type
    $image = null;
    switch ($image_info[2]) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($image_path);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($image_path);
            break;
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($image_path);
            break;
        case IMAGETYPE_WEBP:
            $image = imagecreatefromwebp($image_path);
            break;
        default:
            return false;
    }
    
    if ($image === false) {
        return false;
    }
    
    // Get original dimensions
    $width = imagesx($image);
    $height = imagesy($image);
    
    // Calculate new dimensions (max 500x500)
    $max_size = 500;
    $ratio = min($max_size / $width, $max_size / $height);
    $new_width = intval($width * $ratio);
    $new_height = intval($height * $ratio);
    
    // Create new image with new dimensions
    $resized_image = imagecreatetruecolor($new_width, $new_height);
    
    // Preserve transparency for PNG
    if ($image_info[2] === IMAGETYPE_PNG) {
        imagealphablending($resized_image, false);
        imagesavealpha($resized_image, true);
        $transparent = imagecolorallocatealpha($resized_image, 255, 255, 255, 127);
        imagefilledrectangle($resized_image, 0, 0, $new_width, $new_height, $transparent);
    }
    
    // Resize image
    imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    
    // Convert to grayscale
    imagefilter($resized_image, IMG_FILTER_GRAYSCALE);
    
    // Enhance contrast
    imagefilter($resized_image, IMG_FILTER_CONTRAST, -20);
    
    // Apply threshold (convert to black and white)
    imagefilter($resized_image, IMG_FILTER_THRESHOLD, 127);
    
    // Save as PNG
    $success = imagepng($resized_image, $temp_path, 9); // Compression level 9
    
    // Clean up
    imagedestroy($image);
    imagedestroy($resized_image);
    
    return $success ? $temp_path : false;
}
?>
