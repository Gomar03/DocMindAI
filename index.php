<?php
/**
 * Medical AI Tools Suite - Main Index
 * 
 * A central hub for accessing all medical AI tools in the suite.
 * 
 * @author Costin Stroie <costinstroie@eridu.eu.org>
 * @version 1.0
 * @license GPL 3
 */

// Include common functions for language support
include 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical AI Tools Suite</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-top: 20px;
        }
        
        .tool-card {
            background: #f9fafb;
            border-radius: 12px;
            padding: 24px;
            border: 2px solid #e5e7eb;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            color: inherit;
        }
        
        .tool-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
        }
        
        .tool-icon {
            font-size: 2rem;
            margin-bottom: 16px;
        }
        
        .tool-card h3 {
            color: #111827;
            margin-bottom: 8px;
            font-size: 1.25rem;
        }
        
        .tool-card p {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .tool-card .btn {
            display: inline-block;
            width: auto;
            padding: 8px 16px;
            margin-top: 16px;
            font-size: 0.9rem;
        }
        
        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .welcome-section h2 {
            font-size: 1.5rem;
            color: #111827;
            margin-bottom: 12px;
        }
        
        .welcome-section p {
            color: #6b7280;
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <hgroup>
            <h1>🏥 Medical AI Tools Suite</h1>
            <p>AI-powered medical document processing and analysis</p>
        </hgroup>

        <main>
            <div class="welcome-section">
                <h2>Welcome to the Medical AI Tools Suite</h2>
                <p>A collection of specialized tools designed to help medical professionals process, analyze, and extract key information from various medical documents using artificial intelligence.</p>
            </div>
            
            <div class="tools-grid">
                <a href="rra.php" class="tool-card">
                    <div class="tool-icon">🔍</div>
                    <h3>Radiology Report Analyzer</h3>
                    <p>Analyze radiology reports and extract key medical information in a structured JSON format.</p>
                    <div class="btn btn-primary">Access Tool</div>
                </a>
                
                <a href="dpa.php" class="tool-card">
                    <div class="tool-icon">📋</div>
                    <h3>Discharge Paper Analyzer</h3>
                    <p>Analyze patient discharge papers and summarize key medical information for radiology use.</p>
                    <div class="btn btn-primary">Access Tool</div>
                </a>
                
                <a href="ocr.php" class="tool-card">
                    <div class="tool-icon">📷</div>
                    <h3>Image OCR Tool</h3>
                    <p>Perform OCR on uploaded images and extract text in Markdown format.</p>
                    <div class="btn btn-primary">Access Tool</div>
                </a>
                
                <a href="scp.php" class="tool-card">
                    <div class="tool-icon">🔗</div>
                    <h3>Simple Content Parser</h3>
                    <p>Scrape web pages and convert them to clean Markdown format using AI processing.</p>
                    <div class="btn btn-primary">Access Tool</div>
                </a>
                
                <a href="sum.php" class="tool-card">
                    <div class="tool-icon">📝</div>
                    <h3>Web Page Summarizer</h3>
                    <p>Scrape web pages and return a structured summary of the most important points.</p>
                    <div class="btn btn-primary">Access Tool</div>
                </a>
            </div>
            
            <section style="margin-top: 40px; text-align: center;">
                <h3>Configuration</h3>
                <p style="margin-top: 12px;">
                    All tools use a common configuration file. Create a <code>config.php</code> file with your AI API settings:
                </p>
                <pre style="background: #eff6ff; padding: 16px; border-radius: 8px; text-align: left; margin: 16px auto; max-width: 500px; font-size: 0.9rem;">
&lt;?php
$LLM_API_ENDPOINT = 'http://127.0.0.1:11434/v1';
$LLM_API_KEY = '';
$DEFAULT_TEXT_MODEL = 'qwen2.5:1.5b';
$DEFAULT_VISION_MODEL = 'gemma3:4b';
$LLM_API_FILTER = '/free/';
?&gt;</pre>
            </section>
        </main>
    </div>
</body>
</html>
