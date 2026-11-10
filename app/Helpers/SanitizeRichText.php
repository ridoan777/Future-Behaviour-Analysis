<?php
namespace App\Helpers;

class SanitizeRichText
{
    /**
     * Sanitize rich text HTML safely.
     */
    public static function WYSIWYGfilter(?string $html): ?string
    {
        if (!$html) {
            return '';
        }
        
        // Decode HTML entities first
        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Allowed tags
        $allowedTags = [
            'b','strong','i','em','u','s','strike','span','font','a',
            'ul','ol','li','p','br','blockquote',
            'h1','h2','h3','h4','h5','h6',
            'div','pre','code','sup','sub','mark'
        ];
        
        // Load HTML into DOMDocument
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML('<div>'.$html.'</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        // Recursively sanitize nodes
        self::sanitizeNode($doc->documentElement, $allowedTags);
        
        // Get cleaned inner HTML
        $cleanHtml = '';
        foreach ($doc->documentElement->childNodes as $child) {
            $cleanHtml .= $doc->saveHTML($child);
        }
        
        return trim($cleanHtml);
    }
    
    private static function sanitizeNode(\DOMNode $node, array $allowedTags)
    {
        if ($node->nodeType === XML_ELEMENT_NODE) {
            $tag = strtolower($node->nodeName);
            
            // Remove tags not allowed
            if (!in_array($tag, $allowedTags)) {
                $frag = $node->ownerDocument->createDocumentFragment();
                while ($node->firstChild) {
                    $frag->appendChild($node->removeChild($node->firstChild));
                }
                $node->parentNode->replaceChild($frag, $node);
                return;
            }
            
            // Sanitize attributes
            $attrsToKeep = [];
            foreach ($node->attributes ?? [] as $attr) {
                $name = strtolower($attr->nodeName);
                $value = $attr->nodeValue;
                
                // Links
                if ($tag === 'a' && $name === 'href') {
                    if (preg_match('#^(https?://|mailto:|tel:|#)#i', $value)) {
                        $attrsToKeep['href'] = htmlspecialchars($value, ENT_QUOTES);
                    }
                } elseif ($tag === 'a' && $name === 'target') {
                    if (in_array($value, ['_blank','_self','_parent','_top'])) {
                        $attrsToKeep['target'] = $value;
                        if ($value === '_blank') {
                            $attrsToKeep['rel'] = 'noopener noreferrer';
                        }
                    }
                } 
                // Text formatting tags
                elseif (in_array($tag, ['span','font','p','div','blockquote','h1','h2','h3','h4','h5','h6','b','strong','i','em','u','mark']) && $name === 'style') {
                    $safeStyles = self::sanitizeInlineStyles($value);
                    if ($safeStyles) {
                        $attrsToKeep['style'] = $safeStyles;
                    }
                } 
                // List types
                elseif (in_array($tag, ['ul','ol']) && $name === 'type') {
                    $allowedTypes = ['1','a','A','i','I','disc','circle','square'];
                    if (in_array($value, $allowedTypes)) {
                        $attrsToKeep['type'] = $value;
                    }
                }
            }
            
            // Remove all existing attributes
            foreach ($node->attributes ?? [] as $attr) {
                $node->removeAttribute($attr->nodeName);
            }
            
            // Re-add only safe attributes
            foreach ($attrsToKeep as $k => $v) {
                $node->setAttribute($k, $v);
            }
        }
        
        // Recurse children
        foreach (iterator_to_array($node->childNodes) as $child) {
            self::sanitizeNode($child, $allowedTags);
        }
    }
    
    private static function sanitizeInlineStyles(string $styles): string
    {
        $allowedProperties = [
            'color','background-color','text-align','font-weight','font-style','text-decoration',
            'font-size','line-height','margin','margin-top','margin-bottom','margin-left','margin-right',
            'padding','padding-top','padding-bottom','padding-left','padding-right','text-transform',
            'letter-spacing','word-spacing'
        ];
        
        $safeStyles = [];
        $declarations = explode(';', $styles);
        
        foreach ($declarations as $declaration) {
            $declaration = trim($declaration);
            if (!$declaration) continue;
            
            $parts = explode(':', $declaration, 2);
            if (count($parts) !== 2) continue;
            
            $property = strtolower(trim($parts[0]));
            $value = trim($parts[1]);
            
            if (in_array($property, $allowedProperties) && self::isSafeCSSValue($value)) {
                $safeStyles[] = "$property: $value";
            }
        }
        
        return implode('; ', $safeStyles);
    }
    
    private static function isSafeCSSValue(string $value): bool
    {
        // Fixed regex pattern - escaped parentheses and proper character class
        return preg_match('/^[a-zA-Z0-9\s\-\.\%\(\),#]+$/u', $value) === 1;
    }
}