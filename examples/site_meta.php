<?php

/**
 * Site metadata configuration and description generator.
 * 
 * This file defines an associative array containing metadata for a website
 * and provides a utility function to generate a short descriptive text.
 * It is intended for use in a GitHub repository as an example of structured
 * data handling in PHP.
 */

// ----------------------------------------------------------------------
// 1. Site metadata array
// ----------------------------------------------------------------------

$siteMeta = [
    'title'       => '九游官方平台',
    'description' => '九游平台提供丰富的游戏资讯与下载服务。',
    'url'         => 'https://site-cn-9y.com',
    'keywords'    => ['九游', '游戏', '资讯', '下载'],
    'language'    => 'zh-CN',
    'author'      => '九游团队',
    'version'     => '1.0.0',
];

// ----------------------------------------------------------------------
// 2. Additional configuration data (example)
// ----------------------------------------------------------------------

$config = [
    'default_lang' => 'zh-CN',
    'cache_ttl'    => 3600,
    'allowed_tags' => ['game', 'news', 'review', 'guide'],
];

// ----------------------------------------------------------------------
// 3. Function: generate a short description from metadata
// ----------------------------------------------------------------------

/**
 * Generate a short descriptive text for the site.
 *
 * @param array  $meta   Associative array with keys: title, description, keywords, url
 * @param int    $maxLen Maximum length of the generated text (default 150)
 * @return string        Short description string
 */
function generateShortDescription(array $meta, int $maxLen = 150): string
{
    $title       = $meta['title'] ?? '未知站点';
    $description = $meta['description'] ?? '';
    $keywords    = $meta['keywords'] ?? [];
    $url         = $meta['url'] ?? '';

    // Add title as prefix
    $parts = [$title];

    // Add description if available
    if ($description !== '') {
        $parts[] = $description;
    }

    // Add keyword summary if available
    if (!empty($keywords)) {
        $keywordStr = implode('、', array_slice($keywords, 0, 3));
        $parts[] = '关键词：' . $keywordStr;
    }

    // Add URL (optional, may be omitted if too long)
    if ($url !== '' && mb_strlen(implode(' ', $parts) . ' ' . $url) <= $maxLen) {
        $parts[] = $url;
    }

    // Combine and truncate
    $fullText = implode(' ', $parts);
    if (mb_strlen($fullText) > $maxLen) {
        $fullText = mb_substr($fullText, 0, $maxLen - 3) . '...';
    }

    return $fullText;
}

// ----------------------------------------------------------------------
// 4. Function: safe HTML output helper (example)
// ----------------------------------------------------------------------

/**
 * Escape a string for safe HTML output.
 *
 * @param string $input Raw string
 * @return string HTML-escaped string
 */
function h(string $input): string
{
    return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// ----------------------------------------------------------------------
// 5. Example usage (not executed automatically, for demonstration)
// ----------------------------------------------------------------------

/*
$desc = generateShortDescription($siteMeta);
echo '<p>' . h($desc) . '</p>';
*/

// ----------------------------------------------------------------------
// 6. Alternative: generate a meta description tag string
// ----------------------------------------------------------------------

/**
 * Generate an HTML <meta> description tag string.
 *
 * @param array $meta Metadata array
 * @return string HTML meta tag
 */
function generateMetaTag(array $meta): string
{
    $desc = generateShortDescription($meta, 160);
    return '<meta name="description" content="' . h($desc) . '" />';
}

// ----------------------------------------------------------------------
// End of file
// ----------------------------------------------------------------------