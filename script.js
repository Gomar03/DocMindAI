// JSON syntax highlighting function
function jsonSyntaxHighlight(json) {
    if (typeof json !== 'string') {
        json = JSON.stringify(json, undefined, 2);
    }
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        let cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

// YAML syntax highlighting function
function yamlSyntaxHighlight(yaml) {
    // Escape HTML entities
    yaml = yaml.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

    // Highlight string values (quoted strings)
    yaml = yaml.replace(/"([^"]*)"/g, '<span class="string">"$1"</span>');
    //yaml = yaml.replace(/'([^']*)'/g, '<span class="string">\'$1\'</span>');

    // Highlight keys (lines ending with ":")
    yaml = yaml.replace(/^(\s*[a-zA-Z0-9_-]+:)(.*)$/gm, function(match, key, rest) {
        return '<b class="key">' + key + '</b>' + rest;
    });

    // Highlight numbers
    yaml = yaml.replace(/\b(\d+(\.\d+)?)\b/g, '<span class="number">$1</span>');

    // Highlight booleans
    yaml = yaml.replace(/\b(true|false)\b/gi, '<span class="boolean">$1</span>');

    // Highlight null
    yaml = yaml.replace(/\b(null|~)\b/gi, '<span class="null">$1</span>');

    // Highlight comments
    yaml = yaml.replace(/#.*$/gm, '<i class="comment">$&</i>');

    return yaml;
}
