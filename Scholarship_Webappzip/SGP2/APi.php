<?php
// Include the Simple HTML DOM Parser library
include('simple_html_dom.php');

// URL of the page to scrape
$url = "https://scholarshipforme.com/scholarships";

// Create a new DOM object
$html = file_get_html($url);

// Check if the page was successfully fetched
if ($html !== false) {
    // Start container with rounded edges
    echo '<div style="border-radius: 10px; background-color: #f0f0f0; padding: 20px; margin: 20px;">';

    // Find all elements with class "resume-item"
    $resumeItems = $html->find('div.resume-item');

    // Iterate through each resume item and extract data
    foreach ($resumeItems as $index => $item) {
        // Extract image URL
        $imageElement = $item->find('a img', 0);
        $imageUrl = $imageElement ? $imageElement->src : '';

        // Extract title
        $titleElement = $item->find('div.right h3 a', 0);
        $title = $titleElement ? trim($titleElement->plaintext) : '';

        // Output the fetched data in a container with rounded edges
        echo '<div style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 20px; display: flex;">';
        // Display the image with adjusted width
        if ($imageUrl) {
            echo "<img src='$imageUrl' alt='Scholarship Image' style='max-width: 120px; max-height: 100px; margin-right: 20px;'>";
        } else {
            echo "Image not found.";
        }

        // Display the title beside the image
        echo "<div>";
        echo "<h3>$title</h3>";

        // Extract location
        $locationElement = $item->find('div.right ul.skills li i.lni-map-marker', 0);
        $location = $locationElement ? trim($locationElement->parent()->plaintext) : '';

        // Extract "Application Open" status
        $statusElement = $item->find('div.right ul.skills li span.sc-active', 0);
        $status = $statusElement ? trim($statusElement->plaintext) : '';

        // Extract content
        $contentElement = $item->find('div.right p', 0);
        $content = $contentElement ? trim($contentElement->plaintext) : '';

        // Output the rest of the data
        echo "<p><strong>Location:</strong> $location</p>";
        // Display "Application Open" status
        echo "<p><strong>Status:</strong> $status</p>";
        echo "<p><strong>Content:</strong> $content</p>";
        echo "</div>";
        echo "</div>"; // End of container for this item
    }

    // End of container with rounded edges
    echo '</div>';

    // Add double space after all scholarships
    echo '<div style="margin-bottom: 40px;"></div>';
} else {
    echo "Failed to fetch the page.\n";
}
?>
