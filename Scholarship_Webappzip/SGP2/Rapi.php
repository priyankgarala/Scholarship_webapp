<?php
include 'simple_html_dom.php'; // Include Simple HTML DOM Parser library

function extract_text_from_json($data, &$text_list) {
    // Your implementation of extract_text_from_json function in PHP
}

function extract_table_data($table, &$text_list) {
    // Your implementation of extract_table_data function in PHP
}



function get_data($name, $lan) {
    // Define an empty array to store scholarship data
    $data = array();
    
    // Construct the URL based on the scholarship name and language
    $url = "https://www.myscheme.gov.in/_next/data/g2B4hCZEdNIvelrhpkpHA/{$lan}/schemes/{$name}.json";

    // Fetch data from the URL
    $response = file_get_contents($url);

    // Check if data was fetched successfully
    if ($response !== false) {
        // Convert JSON response to associative array
        $api_data = json_decode($response, true);

        // Extract data from the API response
        try {
            $state_name = $api_data['pageProps']['schemeData'][$lan]['basicDetails']['state']['label'];
            $data['state_name'] = $state_name;
        } catch (Exception $e) {
            $data['state_name'] = null;
        }

        try {
            // Extract other fields similarly
            // For example:
            // $data['scheme_open_date'] = $api_data['pageProps']['schemeData'][$lan]['basicDetails']['schemeOpenDate'];
            // $data['scheme_close_date'] = $api_data['pageProps']['schemeData'][$lan]['basicDetails']['schemeCloseDate'];
            // $data['nodal_department_name'] = $api_data['pageProps']['schemeData'][$lan]['basicDetails']['nodalDepartmentName']['label'];
            // $data['nodal_ministry_name'] = $api_data['pageProps']['schemeData'][$lan]['basicDetails']['nodalMinistryName']['label'];
            // $data['tags'] = $api_data['pageProps']['schemeData'][$lan]['basicDetails']['tags'];
            // $data['scholarship_name'] = $api_data['pageProps']['schemeData'][$lan]['basicDetails']['schemeName'];
            // $data['references'] = $api_data['pageProps']['schemeData'][$lan]['schemeContent']['references'];
            // $data['benefits'] = extract_text_from_json($api_data['pageProps']['schemeData'][$lan]['schemeContent']['benefits']);
            // $data['detail'] = extract_text_from_json($api_data['pageProps']['schemeData'][$lan]['schemeContent']['detailedDescription']);
            // $data['eligibility'] = extract_text_from_json($api_data['pageProps']['schemeData'][$lan]['eligibilityCriteria']['eligibilityDescription']);
            // $data['required_documents'] = extract_text_from_json($api_data['pageProps']['docs']['data'][$lan]['documents_required']);
            // $data['process_step'] = extract_text_from_json($api_data['pageProps']['schemeData'][$lan]['applicationProcess']);
            // $data['faqs'] = $api_data['pageProps']['faqs']['data'][$lan]['faqs'];
        } catch (Exception $e) {
            // Handle exceptions
        }
    }

    return $data;
}

?>


$app = new \Slim\Slim();
$app->get('/:name', function ($name) {
    $data = get_data($name, "en");
    echo json_encode(['data' => $data]);
});

$app->get('/hi/:name', function ($name) {
    $data = get_data($name, "hi");
    echo json_encode(['data' => $data]);
});

$app->run();
?>
