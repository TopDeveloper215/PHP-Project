<?php

$filename = uniqid() . '.png';
$font = isset($_POST['font']) ? $_POST['font'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
$font_size = isset($_POST['font_size']) ? $_POST['font_size'] : null;
$background_color = isset($_POST['background_color']) ? $_POST['background_color'] : null;
$stroke_color = isset($_POST['stroke_color']) ? $_POST['stroke_color'] : null;
$stroke_size = isset($_POST['stroke_size']) ? $_POST['stroke_size'] : null;
$shadow_color = isset($_POST['shadow_color']) ? $_POST['shadow_color'] : null;
$shadow_size = isset($_POST['shadow_size']) ? $_POST['shadow_size'] : null;
$gradient_start = isset($_POST['gradient_start']) ? $_POST['gradient_start'] : null;
$gradient_end = isset($_POST['gradient_end']) ? $_POST['gradient_end'] : null;
$gradient_angle = isset($_POST['gradient_angle']) ? $_POST['gradient_angle'] : null;
$gradient_type = isset($_POST['gradient_type']) ? $_POST['gradient_type'] : null;
$arc = isset($_POST['arc']) ? $_POST['arc'] : null;
$circle = isset($_POST['circle']) ? $_POST['circle'] : null;
$spiral = isset($_POST['spiral']) ? $_POST['spiral'] : null;
$blur = isset($_POST['blur']) ? $_POST['blur'] : null;
$smoke = isset($_POST['smoke']) ? $_POST['smoke'] : null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$command = 'magick convert -pointsize ' . $font_size . ' ';
	
	$command .= '-background none label:"' . $text . '" ';
    
	if ($font) $command .= '-font ' . $font . ' ';

    if ($stroke_color) $command .= '-stroke "' . $stroke_color . '" -strokewidth ' . $stroke_size . ' ';

    if ($gradient_start) $command .= '( +clone -sparse-color Barycentric "0,%h ' . $gradient_start . ' %w,0 ' . $gradient_end . '" ) -compose In -composite ';

    if ($spiral) $command .= '-rotate ' . $spiral . ' ';
	
    if ($arc) $command .= '-virtual-pixel transparent -distort arc ' . $arc . ' ';

    if ($shadow_color) $command .= '( +clone -background ' . $shadow_color . ' -shadow 100x2+' . $shadow_size . '+' . $shadow_size . ' ) +swap ';
	
	//if ($blur) $command .= '-motion-blur ' . $blur . ' ';

    $command .= '-background ' . ($background_color ? $background_color : 'none') . ' -compose over -layers merge +repage tmp/' . $filename;

    echo "<pre>{$command}</pre><br /><img src='tmp/{$filename}' />";
    exec($command);
}
?>

<form method="post">
    <p>Font Filename: <input type="text" name="font" value="<?php echo $font ?: '' ?>" /></p>
    <p>Preview Text: <input type="text" name="text" value="<?php echo $text ?: '' ?>" /></p>
    <p>Font Size: <input type="number" name="font_size" value="<?php echo $font_size ?: '' ?>" /></p>
    <p>Background Color: <input type="text" name="background_color" value="<?php echo $background_color ?: '' ?>" /></p>
    <p>Stroke Color: <input type="text" name="stroke_color" value="<?php echo $stroke_color ?: '' ?>" /></p>
    <p>Stroke Size: <input type="number" name="stroke_size" value="<?php echo $stroke_size ?: '' ?>" /></p>
    <p>Shadow Color: <input type="text" name="shadow_color" value="<?php echo $shadow_color ?: '' ?>" /></p>
    <p>Shadow Size: <input type="number" name="shadow_size" value="<?php echo $shadow_size ?: '' ?>" /></p>
    <p>Gradient Start: <input type="text" name="gradient_start" value="<?php echo $gradient_start ?: '' ?>" /></p>
    <p>Gradient End: <input type="text" name="gradient_end" value="<?php echo $gradient_end ?: '' ?>" /></p>
    <p>Gradient Angle: <input type="number" name="gradient_angle" value="<?php echo $gradient_angle ?: '' ?>" /></p>
    <p>Gradient Type: <select name="gradient_type">
            <option value="linear" <?php if($gradient_type == 'linear') echo 'selected' ?>>Linear</option>
            <option value="radial" <?php if($gradient_type == 'radial') echo 'selected' ?>>Radial</option>
        </select></p>
    <p>Arc: <input type="number" name="arc" value="<?php echo $arc ?: '' ?>" /></p>
	<p>Circle: <input type="number" name="circle" value="<?php echo $circle ?: '' ?>" /></p>
    <p>Spiral: <input type="number" name="spiral" value="<?php echo $spiral ?: '' ?>" /></p>
	<p>MotionBlur: <input type="text" name="blur" value="<?php echo $blur ?: '' ?>" /></p>
	<p>Smoke: <input type="number" name="smoke" value="<?php echo $smoke ?: '' ?>" /></p>

    <p><input type="submit" /></p>
</form>