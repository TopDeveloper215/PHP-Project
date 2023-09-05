<?php
// Include the configuration file
require_once 'config.php';
    
// Grab the password from the query string
$oauthPass = trim($_SERVER['QUERY_STRING']);

// Verify the oauth password
if($oauthPass != OAUTH_PASSWORD){
    echo "false";
    // Return 404 error, if not a correct path
    header("HTTP/1.0 404 Not Found");
    exit;
}else{    
    // Create a list of links to display the download files
    $download_links = array();
    
    // If the files exist
    if(is_array($files)){
        foreach($files as $fid => $file){
            // Encode the file ID
            $fid = base64_encode($fid);
            
            // Generate new unique key
            $key = uniqid(time().'-key',TRUE);
            
            // Generate download link
            $download_link = DOWNLOAD_PATH."?fid=$fid&key=".$key; 
            
            // Add download link to the list
            $download_links[] = array(
                'link' => $download_link
            );
            
            // Create a protected directory to store keys
            if(!is_dir(TOKEN_DIR)) {
                mkdir(TOKEN_DIR);
                $file = fopen(TOKEN_DIR.'/.htaccess','w');
                fwrite($file,"Order allow,deny\nDeny from all");
                fclose($file);
            }
            
            // Write the key to the keys list
            $file = fopen(TOKEN_DIR.'/keys','a');
            fwrite($file, "{$key}\n");
            fclose($file);
        }
    }
}    
?>

<!-- List all the download links -->
<?php if(!empty($download_links)){ ?>
    <ul>
    <?php foreach($download_links as $download){ ?>            
        <li><a href="<?php echo $download['link']; ?>"><?php echo  $download['link']; ?></a></li>
    <?php } ?>
    </ul>
<?php }else{ ?>
    <p>Links are not found...</p>
<?php } ?>