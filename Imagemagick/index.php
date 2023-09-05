<?php
$filename = uniqid() . '.png';
$label = isset($_POST['label']) ? $_POST['label'] : null;
$fontfamily = isset($_POST['fontfamily']) ? $_POST['fontfamily'] : null;
$fontsize = isset($_POST['fontsize']) ? $_POST['fontsize'] : 50;
$template = isset($_POST['template']) ? $_POST['template'] : "none";
$fontcolor = isset($_POST['fontcolor']) ? $_POST['fontcolor'] : null;
$gradient_start = isset($_POST['gradient_start']) ? $_POST['gradient_start'] : null;
$gradient_end = isset($_POST['gradient_end']) ? $_POST['gradient_end'] : null;
$shadow_color = isset($_POST['shadow_color']) ? $_POST['shadow_color'] : null;
$outline = isset($_POST['outline']) ? $_POST['outline'] : null;
$outline_color = isset($_POST['outline_color']) ? $_POST['outline_color'] : null;
$style_color = isset($_POST['style_color']) ? $_POST['style_color'] : null;
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$command = "";
	if($template == "none") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
	} else if($template == "gradienth") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" ( +clone -sparse-color Barycentric "0,%h ' . $gradient_start . ' %w,0 ' . $gradient_end . '" ) -compose In -composite tmp/' . $filename;
	} else if($template == "gradientv") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" ( +clone -sparse-color Barycentric "0,0 ' . $gradient_start . ' 0,%h ' . $gradient_end . '" ) -compose In -composite tmp/' . $filename;
	} else if($template == "gradientr") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -tile radial-gradient:' . $gradient_start . '-' . $gradient_end . ' -gravity center -annotate +0+0 "' . $label . '" tmp/' . $filename;
	} else if($template == "shadows") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" ( +clone -background ' . $shadow_color . ' -shadow 60x2+3+3 ) +swap -background none -compose over -layers merge +repage tmp/' . $filename;
	} else if($template == "shadowl") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" ( +clone -background ' . $shadow_color . ' -shadow 100x2+3+3 ) +swap -background none -compose over -layers merge +repage tmp/' . $filename;
	} else if($template == "shadowsolids") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke ' . $shadow_color . ' label:"' . $label . '" ( +clone -background ' . $shadow_color . ' -shadow 100x2+3+3 ) +swap -background none -compose over -layers merge +repage tmp/' . $filename;
	} else if($template == "shadowsolidl") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor  . '-stroke'.$shadow_color.' label:"' . $label . '" ( +clone -background ' . $shadow_color . ' -shadow 100x0+4+2 )  +swap -background none -compose over -layers merge +repage tmp/' . $filename;
	} else if($template == "shadowstripe") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke white -strokewidth 3 label:"' . $label . '" ( +clone -background none -fill ' . $shadow_color . ' -tile img/stripe.png ) +swap -background none -compose over -layers merge +repage tmp/' . $filename;
	} else if($template == "outlinea") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill transparent -stroke ' . $outline_color . ' -strokewidth 1 label:"' . $label . '" tmp/' . $filename;
	} else if($template == "outlineb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke ' . $outline_color . ' -strokewidth 1 label:"' . $label . '" tmp/' . $filename;
	} else if($template == "outlined") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width+4 . 'x' . $height+4 . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none -stroke ' . $fontcolor . ' -strokewidth 3 -gravity center -annotate +0+0 "' . $label . '" -fill none -stroke white -strokewidth 1 -gravity center -annotate +0+0 "' . $label . '" tmp/' . $filename;
	} else if($template == "outlinetransparent") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none -stroke ' . $fontcolor . ' -strokewidth 1 label:"' . $label . '" tmp/' . $filename;
	} else if($template == "styleanimadow") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke ' . $style_color . ' -strokewidth 2 label:"' . $label . '" ( +clone -background ' . $style_color . ' -shadow 100x0+0-6 ) +swap -virtual-pixel transparent -distort arc 80 -background none -compose over -layers merge +repage tmp/' . $filename;
	} else if($template == "styleapple") {
		$tempname = uniqid();
		$tempname1 = uniqid();
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill #95D639  label:"' . $label . '" ( +clone -background red -shadow 100x2+1+1 ) +swap -background none -compose over -layers merge +repage tmp/' . $tempname . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x50% tmp/' . $tempname . '.png tmp/' . $tempname . '.png';
		exec($command);
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill #48AE47  label:"' . $label . '" ( +clone -background red -shadow 100x2+1+1 ) +swap -background none -compose over -layers merge +repage tmp/' . $tempname1 . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x50% tmp/' . $tempname1 . '.png tmp/' . $tempname1 . '.png';
		exec($command);
		$command = 'magick convert -append tmp/' . $tempname . '-0.png tmp/' . $tempname1 . '-1.png tmp/' . $filename;
		exec($command);
		
	} else if($template == "stylebackwooa") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . ($width+30) . 'x' . ($height+30) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize 72 -fill ' . $fontcolor . ' label:"' . $label . '" -stroke black -strokewidth 30 -gravity center -annotate +0+0 "' . $label . '" -stroke ' . $style_color . ' -strokewidth 28 -gravity center -annotate +0+0 "' . $label . '" -stroke none -gravity center -annotate +0+0 "' . $label . '" -virtual-pixel transparent -distort arc 60 -compose In -composite -layers merge +repage tmp/'.$filename;
	} else if($template == "stylebackwoob") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . ($width+30) . 'x' . ($height+30) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize 72 -fill ' . $fontcolor . ' label:"' . $label . '" -stroke black -strokewidth 30 -gravity center -annotate +0+0 "' . $label . '" -stroke ' . $style_color . ' -strokewidth 28 -gravity center -annotate +0+0 "' . $label . '" -stroke none -gravity center -annotate +0+0 "' . $label . '" -compose In -composite -layers merge +repage tmp/'.$filename;
	} else if($template == "stylebanner") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$tempfile = uniqid();
		$command = 'magick convert img/banner.png ( +clone -fill ' . $style_color . ' -draw "color 0,0 reset" ) -compose atop -composite tmp/' . $tempfile . '.png';
		exec($command);
		$command = 'magick convert tmp/' . $tempfile . '.png -resize ' . ($width+200) . 'x' . ($height+60) . ' tmp/' . $tempfile . '.png';
		exec($command);
		$command = 'magick convert tmp/' . $tempfile . '.png -gravity center -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -font fonts/' . $fontfamily . '.ttf -annotate +0+0 "' . $label . '" tmp/'.$filename;
	} else if($template == "stylebendient") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' .  $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -stroke black -strokewidth 2 -tile gradient:' . $fontcolor . '-' . $style_color . ' -gravity center -annotate +0+0 "' . $label . '"  tmp/' . $filename;
	} else if($template == "stylebevelg") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -tile img/texture.jpg    -gravity center -annotate +0+0 "' . $label . '"   tmp/' . $filename;
	}
	// New Line --stylebevelg
	
	
	
	

	
	
	
	
	else if($template == "stylebttf") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+20) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill gradient:red-gold   -stroke ' . $fontcolor . ' -strokewidth 3 -gravity center -annotate 0x20+0+0  "' . $label . '" -matte -virtual-pixel transparent -distort Perspective " 10,0 20,0   10,150 20,150   120,160 100,130   90,30 90,40"  tmp/' . $filename;

	}
	else if($template == "stylechocolate") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke rgb(166,166,166) -strokewidth 9 -gravity center -annotate +2+2  ' . $label . '   -stroke rgb(215,212,193) -strokewidth 9 -gravity center -annotate +0+0  ' . $label . ' -stroke white -strokewidth 3 -gravity center -annotate +0+0  "' . $label . '"  tmp/' . $filename;

	}
	else if($template == "stylecolombia") {
		$tempname = uniqid();
		$tempname1 = uniqid();
		$tempname2 = uniqid();
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill gold  label:"' . $label . '"  tmp/' . $tempname . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x40% tmp/' . $tempname . '.png tmp/' . $tempname . '.png ';
		exec($command);
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill blue  label:"' . $label . '"  tmp/' . $tempname1 . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x20% tmp/' . $tempname1 . '.png tmp/' . $tempname1 . '.png  ';
		exec($command);
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill red  label:"' . $label . '"  tmp/' . $tempname2 . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x20% tmp/' . $tempname2 . '.png tmp/' . $tempname2 . '.png  ' ;
		exec($command);
		$command = 'magick convert -append tmp/' . $tempname . '-0.png tmp/' . $tempname1 . '-2.png tmp/' . $tempname2 . '-3.png tmp/' . $filename;
		exec($command);

		
	} 
	else if($template == "stylecomic") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill gradient:yellow-red -stroke ' . $fontcolor . ' -strokewidth 1 -gravity center -annotate +0+0  "' . $label . '" tmp/' . $filename;

	}
	else if($template == "styleconcaveb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . ($height+20) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . '  -gravity center -annotate +0+0 "' . $label . '"  -gravity center -annotate 1x0-1+0 "' . $label . '"  -matte -virtual-pixel transparent -distort Shepards " ' . ($width - $width) . ',' . ($height) . '  ' . ($width - $width) . ',' . ($height+$height / 24) . ' ' . ($width / 2) . ',' . ($height) . ' ' . ($width / 2) . ',' . ($height-$height / 8) . '  ' . ($width) . ',' . ( $height) . ' ' . ($width ) . ',' . ($height+$height / 24) . ' "   tmp/' . $filename;
	
	}
	else if($template == "styleconcavebb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . ($height+20) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . '  -gravity center -annotate +0+0 "' . $label . '"  -gravity center -annotate 1x0-1+0 "' . $label . '"  -matte -virtual-pixel transparent -distort Shepards " ' . ($width - $width) . ',' . ($height) . '  ' . ($width - $width) . ',' . ($height+$height / 24) . ' ' . ($width / 2) . ',' . ($height) . ' ' . ($width / 2) . ',' . ($height-$height / 2) . '  ' . ($width) . ',' . ( $height) . ' ' . ($width ) . ',' . ($height+$height / 24) . ' "   tmp/' . $filename;
	
	}
	else if($template == "styleconcavet") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width) . 'x' . ($height) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' "' . $label . '"   -gravity center -annotate +0+0 "' . $label . '" -matte -virtual-pixel transparent -distort Shepards " ' . ($width - $width) . ',' . ($height - $height) . '  ' . ($width - $width) . ',-' . ($height / 24) . ' ' . ($width / 2) . ',' . ($height - $height) . ' ' . ($width / 2) . ',' . ($height / 5) . '  ' . ($width) . ',' . ($height - $height) . ' ' . ($width ) . ',' . -($height / 24) . ' "  tmp/' . $filename;
		

	}
	else if($template == "styleconcavett") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width) . 'x' . ($height) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' "' . $label . '"   -gravity center -annotate +0+0 "' . $label . '" -matte -virtual-pixel transparent -distort Shepards " ' . ($width - $width) . ',' . ($height - $height) . '  ' . ($width - $width) . ',-' . ($height / 24) . ' ' . ($width / 2) . ',' . ($height - $height) . ' ' . ($width / 2) . ',' . ($height / 2.5) . '  ' . ($width) . ',' . ($height - $height) . ' ' . ($width ) . ',' . -($height / 24) . ' "  tmp/' . $filename;
		

	}
	else if($template == "stylecondense") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . '    -gravity center -annotate +0+0   "' . $label . '" -scale 100x100 tmp/' . $filename;

	}
	else if($template == "stylecupadow") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke ' . $outline_color . ' -strokewidth 2 -gravity center -annotate +0+0  ' . $label . ' -background ' . $outline_color . ' -shadow 100x0+3+3 -gravity center -annotate +0+0 "' . $label . '"  tmp/' . $filename;

	}
	else if($template == "styledragonb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width) . 'x' . ($height) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' "' . $label . '"  -background black   -shadow 100x0+2+1 -gravity center -annotate +0+0 "' . $label . '" -matte -virtual-pixel transparent -distort Shepards " ' . ($width - $width) . ',' . ($height - $height) . '  ' . ($width - $width) . ',-' . ($height / 24) . ' ' . ($width / 2) . ',' . ($height - $height) . ' ' . ($width / 2) . ',' . ($height / 6) . '  ' . ($width) . ',' . ($height - $height) . ' ' . ($width ) . ',' . -($height / 24) . ' "  tmp/' . $filename;
		

	}
	else if($template == "stylefrozen") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/stylefrozen-7.png  -gravity center -annotate +0+0 "' . $label . '" -background ' . $shadow_color . '  -shadow 100x0+1+1 -gravity center -annotate 1x0-1+0 "' . $label . '"  -matte -virtual-pixel transparent -distort Shepards " ' . ($width - $width) . ',' . ($height) . '  ' . ($width - $width) . ',' . ($height+$height / 24) . ' ' . ($width / 2) . ',' . ($height) . ' ' . ($width / 2) . ',' . ($height-$height / 6) . '  ' . ($width) . ',' . ( $height) . ' ' . ($width ) . ',' . ($height+$height / 24) . ' "   tmp/' . $filename;
	
	}
	else if($template == "stylegaldient") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+5) . 'x' . ($width+15) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . '  -fill gradient:' . $gradient_start . '-' . $gradient_end . ' -stroke white -strokewidth 10  -gravity center -annotate +0+0      "' . $label . '" -stroke black -strokewidth 2   -gravity center -annotate +0+0      "' . $label . '"  tmp/'  . $filename;

	}
	else if($template == "stylegermany") {
		$tempname = uniqid();
		$tempname1 = uniqid();
		$tempname2 = uniqid();
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill black  label:"' . $label . '"  tmp/' . $tempname . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x40% tmp/' . $tempname . '.png tmp/' . $tempname . '.png ';
		exec($command);
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill red  label:"' . $label . '"  tmp/' . $tempname1 . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x20% tmp/' . $tempname1 . '.png tmp/' . $tempname1 . '.png tmp/' . $tempname1 . '.png tmp/' . $tempname1 . '.png tmp/' . $tempname1 . '.png';
		exec($command);
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill yellow  label:"' . $label . '"  tmp/' . $tempname2 . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x33.33% tmp/' . $tempname2 . '.png tmp/' . $tempname2 . '.png  tmp/' . $tempname2 . '.png ' ;
		exec($command);
		$command = 'magick convert -append tmp/' . $tempname . '-0.png tmp/' . $tempname1 . '-2.png tmp/' . $tempname2 . '-2.png tmp/' . $filename;
		exec($command);

		
	} 
	else if($template == "styleindianajones") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+5) . 'x' . ($width+15) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . '  -fill gradient:red-yellow -stroke ' . $fontcolor . ' -strokewidth 2   -gravity center -annotate +0+0      "' . $label . '"  tmp/'  . $filename;

	}
	else if($template == "stylekiss") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+5) . 'x' . ($width+15) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . '  -fill gradient:red-yellow -stroke ' . $fontcolor . ' -strokewidth 2   -gravity center -annotate +0+0  "' . $label . '"  tmp/' . $filename;

	}
	else if($template == "stylemango") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+5) . 'x' . ($width+15) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . '  -fill gradient:green-gold -stroke ' . $fontcolor . ' -strokewidth 2   -gravity center -annotate +0+0  "' . $label . '"  tmp/' . $filename;

	}

	else if($template == "stylemariadow") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+15) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke ' . $outline_color . ' -strokewidth 1 -gravity center -annotate +0+0 "' . $label . '" -background ' . $outline_color . '   -shadow 100x0+1.3+1.3 -gravity center -annotate +0+0 "' . $label . '"   -shadow 100x0+1+1 -gravity center -annotate 1x0-1+0 "' . $label . '"    -shadow 100x0+1.2+1.2 -gravity center -annotate -1.2+0 "' . $label . '"  -shadow 100x0+1+1 -gravity center -annotate -1.3+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.4+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.5+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.6+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.7+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.8+0 "' . $label . '" -shadow 100x0+1.2+1.2 -gravity center -annotate -1.9+0 "' . $label . '"  -shadow 100x0+1+1 -gravity center -annotate -2+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.1+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.2+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.3+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.4+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.5+0 "' . $label . '"   -shadow 100x0+1.2+1.2 -gravity center -annotate -2.6+0 "' . $label . '"  -shadow 100x0+1+1 -gravity center -annotate -2.7+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.8+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.9+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.0+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.1+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.2+0 "' . $label . '" -shadow 100x0+1.2+1.2 -gravity center -annotate -3.3+0 "' . $label . '"  -shadow 100x0+1+1 -gravity center -annotate -3.4+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.5+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.6+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.7+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.8+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -3.9+0 "' . $label . '"  +swap -background none -compose over -layers merge +repage tmp/' . $filename;

	}
	else if($template == "stylemilky") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width + 15) . 'x' . ($height) . ' xc:none -font fonts/' . $fontfamily . '.ttf  -pointsize ' . $fontsize . ' -fill  ' . $fontcolor . ' label:"' . $label . '"  -stroke yellow -strokewidth 14 -gravity center -annotate +0+0 "' . $label . '" -stroke white -strokewidth 8 -gravity center -annotate +0+0 "' . $label . '" -stroke ' . $fontcolor . ' -strokewidth 1 -gravity center -annotate +0+0  "' . $label . '"   -virtual-pixel transparent  -compose In -composite -layers merge -draw " skewX -20  text 0,0 "   +repage   tmp/'.$filename;
	}
	else if($template == "styleminiadow") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -background ' . $outline_color . '   -shadow 100x0+1.3+1.3 -gravity center -annotate +0+0 "' . $label . '"   -shadow 100x0+1+1 -gravity center -annotate -1+0 "' . $label . '"    -shadow 100x0+1.2+1.2 -gravity center -annotate -1.2+0 "' . $label . '"  -shadow 100x0+1+1 -gravity center -annotate -1.3+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.4+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.5+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.6+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.7+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -1.8+0 "' . $label . '" -shadow 100x0+1.2+1.2 -gravity center -annotate -1.9+0 "' . $label . '"  -shadow 100x0+1+1 -gravity center -annotate -2+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.1+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.2+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.3+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.4+0 "' . $label . '"  -shadow 100x0+0+0 -gravity center -annotate -2.5+0 "' . $label . '" +swap -background none -compose over -layers merge +repage tmp/' . $filename;

	}
	
	else if($template == "styleminecraft") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+30) . 'x' . ($height+30) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke black -strokewidth '.$outline.' -gravity center -annotate +0+0  ' . $label . ' -background black   -shadow 100x0+3+3 -gravity center -annotate +0+0 "' . $label . '" -background black   -shadow 100x0+0+4 -gravity center -annotate +0+0 "' . $label . '" -matte -virtual-pixel transparent -distort Perspective " 0,0,20,0  0,90,0,90  90,0,70,5  90,90,90,90 "  tmp/' . $filename;

	}
	else if($template == "stylenardient") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . '  -fill gradient:' . $fontcolor . '-' . $outline_color . ' -stroke black  -strokewidth 9  -gravity center -annotate +7+5  ' . $label . ' -stroke black  -strokewidth 5  -gravity center -annotate +0+0  ' . $label . '  -stroke white -strokewidth 3 -gravity center -annotate +0+0  "' . $label . '"  tmp/' . $filename;

	}
	else if($template == "styleneon") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . '  -gravity center -annotate +0+0  ' . $label . ' -background ' . $fontcolor . '   -shadow 30x9+9+12 -gravity center -annotate +0+0 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "styleneonbeats") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate 0x20+5+1  ' . $label . ' -background ' . $outline_color . '   -shadow 30x9+9+12 -gravity center -annotate 0x20+1+0 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "styleneonoutline") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none -stroke ' . $outline_color . ' -strokewidth 2 -gravity center -annotate +0+0  ' . $label . ' -background ' . $outline_color . '   -shadow 30x7+9+12 -gravity center -annotate +0+0 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "styleoblique") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill yellow label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+15) . 'x' . ($height+1) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"   -gravity center  -annotate 0x20+0+0  "' . $label . '"     -virtual-pixel transparent -compose In -composite -layers merge -background none   +repage   tmp/'.$filename;

	}
	else if($template == "styleobliquer") {

		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill yellow label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+5) . 'x' . ($height+1) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"   -gravity center  -annotate 0x(-20)+0+0  "' . $label . '"   -virtual-pixel transparent  -compose In -composite -layers merge -background none    +repage   tmp/'.$filename;

	}
	else if($template == "styleoutlinegb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke black -strokewidth 6 -gravity center -annotate +0+0  ' . $label . '  -stroke gray -strokewidth 2 -gravity center -annotate +0+0 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "styleoutlinetp") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill yellow label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+30) . 'x' . ($height+1) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" -stroke ' . $outline_color . ' -strokewidth 15 -gravity center -annotate 0x20+0+0 "' . $label . '" -stroke white -strokewidth 5 -gravity center  -annotate 0x20+0+0  "' . $label . '"   -virtual-pixel transparent  -compose In -composite -layers merge    +repage   tmp/'.$filename;
	}
	else if($template == "styleoutlineyb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke black -strokewidth 6 -gravity center -annotate +0+0  ' . $label . '  -stroke yellow -strokewidth 2 -gravity center -annotate +0+0 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "styleoutlineultra") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill  white  -stroke ' . $fontcolor . '  -strokewidth 10 -gravity center -annotate +0+0  ' . $label . '  -stroke transparent -strokewidth 1 -gravity center -annotate +1+1 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "stylepawp") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke yellow -strokewidth 5 -gravity center -annotate +0+0  ' . $label . '  -stroke rgb(39,101,141) -strokewidth 1  -gravity center -annotate +0+0  "' . $label . '" -distort arc 120  tmp/' . $filename;
	}
	else if($template == "stylepokemon") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke rgb(53,106,188)  -strokewidth 10 -gravity center -annotate +0+0  ' . $label . '  -stroke transparent -strokewidth 1 -gravity center -annotate +1+1 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "stylepolkadot") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . '  -gravity center -annotate +0+0   ' . $label .  '" tmp/' . $filename;

	}
	else if($template == "stylepopstar") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke rgb(120,207,240)  -strokewidth 10 -gravity center -annotate +0+0  ' . $label . '  -stroke white -strokewidth 1 -gravity center -annotate +1+1 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "stylerobt") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill yellow label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" -stroke yellow -strokewidth 28 -gravity center -annotate +0+0 "' . $label . '" -stroke none -gravity center -annotate +0+0 "' . $label . '" -virtual-pixel transparent  -compose In -composite -layers merge +repage tmp/'.$filename;
	}
	else if($template == "stylerotalic") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" ( +clone -background none  -shadow 100x0-2+0 ) +swap -virtual-pixel transparent  -rotate 5 -background none  -compose over -layers merge +repage tmp/' . $filename;

	}
	else if($template == "styleskew") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill white label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert   -size ' . ($width+15) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . '    -gravity center -annotate -8x20+0+0  "' . $label . '"   tmp/' . $filename;


	}
	else if($template == "styleslant") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -rotate -10 label:"' . $label . '"  tmp/' . $filename;

	}
	else if($template == "stylesmashb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '"  tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width) . 'x' . ($height) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' "' . $label . '"  -background black   -shadow 100x0+2+1 -gravity center -annotate +0+0 "' . $label . '" -matte -virtual-pixel transparent -distort Shepards " ' . ($width - $width) . ',' . ($height - $height) . '  ' . ($width - $width) . ',-' . ($height / 24) . ' ' . ($width / 2) . ',' . ($height - $height) . ' ' . ($width / 2) . ',' . ($height / 6) . '  ' . ($width) . ',' . ($height - $height) . ' ' . ($width ) . ',' . -($height / 24) . ' "  tmp/' . $filename;
		

	}
	else if($template == "stylespideroo") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke black -strokewidth 2 label:"' . $label . '" ( +clone -background ' . $shadow_color . ' -shadow 100x0-2+0 ) +swap -virtual-pixel transparent -rotate 180 -distort arc " 50, 180 "  -background none  -compose over -layers merge +repage tmp/' . $filename;

	}
	else if($template == "stylesports") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert  -size ' . ($width+8) . 'x' . ($height+1) . ' xc:none  -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke ' . $fontcolor . ' -strokewidth 5 -gravity center -annotate +0+0  ' . $label . '  -stroke white -strokewidth 3 -gravity center -annotate +0+0 "' . $label . '" tmp/' . $filename;

	}
	else if($template == "stylestarstripes") {
		$tempname = uniqid();
		$tempname1 = uniqid();
		
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -tile pattern:checkerboard   label:"' . $label . '"  tmp/' . $tempname . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x50% tmp/' . $tempname . '.png tmp/' . $tempname . '.png';
		exec($command);
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill #48AE47  label:"' . $label . '" tmp/' . $tempname1 . '.png';
		exec($command);
		$command = 'magick convert -crop 100%x50% tmp/' . $tempname1 . '.png tmp/' . $tempname1 . '.png';
		exec($command);
		$command = 'magick convert -append tmp/' . $tempname . '-0.png tmp/' . $tempname1 . '-1.png tmp/' . $filename;
		exec($command);
		
	}
	else if($template == "stylestarw") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$tempfile = uniqid();
		$command = 'magick convert img/starw.png  tmp/' . $tempfile . '.png';
		exec($command);
		$command = 'magick convert tmp/' . $tempfile . '.png -resize ' . ($width+$fontsize) . 'x' . ($height+$fontsize) . ' tmp/' . $tempfile . '.png';
		exec($command);
		$command = 'magick convert tmp/' . $tempfile . '.png -gravity center -pointsize ' . $fontsize . ' -fill black -stroke ' . $fontcolor . ' -font fonts/' . $fontfamily . '.ttf -annotate +0+0 "' . $label . '" tmp/'.$filename;
	}
	else if($template == "styletoystory") {
		
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor .  ' -stroke rgb(12,75,145) -strokewidth 2 label:"' . $label . '" tmp/' . $filename;

	}
	else if($template == "styletwitch") {
		
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill  white  -stroke '.$fontcolor.' -strokewidth 2 label:"' . $label . '" ( +clone -background red ) -compose In -composite ( +clone -shadow 100x0+6+1 )    +swap -background none -compose over -layers merge +repage tmp/' . $filename;

	}
	else if($template == "styletwitter") {
	
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor  . ' -stroke white -strokewidth 5    label:"' . $label . '" tmp/' . $filename;
		
	}
	else if($template == "shadowuniadow") {
		
			$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -stroke white -strokewidth 1 label:"' . $label . '" ( +clone -background black -shadow 100x0-5+2 ) +swap -background none -compose over -layers merge +repage tmp/' . $filename;
	
	}
	else if($template == "stylewavy") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' -wave -15x80    label:"' . $label . '" tmp/' . $filename;
	} 
	else if($template == "texturecloud") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/texturecloud-3.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "textureglittera") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/textureglittera-15.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "textureglitterb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/textureglitterb-6.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "textureglitterc") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/textureglitterc-10.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "textureglitterd") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/textureglitter-26.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "textureluxury") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/textureluxury-1.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "texturespacea") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/space-a14.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "texturespaceb") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/space-b4.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "texturespacec") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill rgb(2,5,7)' .' -stroke ' . $outline_color . ' -strokewidth '.$outline.' label:"' . $label . '" tmp/' . $filename;
	
	}
	else if($template == "texturespaced") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/space-d5.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "texturespace") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
		exec($command);
		list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
		$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/space4.png -stroke ' . $outline_color . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
	
	}
	else if($template == "texturewaterblue") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill rgb(0,187,234)' .' -stroke ' . $outline_color . ' -strokewidth '.$outline.' label:"' . $label . '" tmp/' . $filename;
	
	}
	else if($template == "texturewaterpink") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill rgb(249,105,138)' .' -stroke ' . $outline_color . ' -strokewidth '.$outline.' label:"' . $label . '" tmp/' . $filename;
	
	}

	else if($template == "texturewatercolor") {
			$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
			exec($command);
			list($width, $height, $type, $attr) = getimagesize("tmp/".$filename);
			$command = 'magick convert -size ' . $width . 'x' . $height . ' xc:none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill none  -tile img/stone.png -stroke ' . $fontcolor . ' -strokewidth '.$outline.' -gravity center -annotate +0+0 "' .  $label . '" tmp/' . $filename;
		
	}
	else if($template == "loadlegacyeffect") {
		$command = 'magick convert -background none -font fonts/' . $fontfamily . '.ttf -pointsize ' . $fontsize . ' -fill ' . $fontcolor . ' label:"' . $label . '" tmp/' . $filename;
	}


	echo "<pre>" . $command . "</pre><br /><img src='tmp/" . $filename . "' />";
	exec($command);
}

?>
<style>
html body {
	width: 100%;
	height: 100%;
	margin: 0;
	text-align: center;
}
div {
	width: 50%;
	height: 100%;
	font-size: 20px;
	display: list-item;
	padding: 10px;
	margin: auto;
}
textarea, input, button {
	width: 100%;
	height: 50px;
}
select {
	width: 100%;
	height: 40px;
}
label {
	height: 25px;
}
.active {
	display: block !important;
}
.disabled {
	display: none;
}
.extra-option {
	height: 200px;
}
</style>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	</head>
	<body>
		<div>
			<form method="post">
				<label>Text</label>
				<textarea name="label" required><?php echo $label; ?></textarea>
				<label>Font</label>
				<select name="fontfamily">
					<option value="candice" <?php if($fontfamily == "candice") echo "selected"; ?>>CANDICE</option>
					<option value="bebasneue" <?php if($fontfamily == "bebasneue") echo "selected"; ?>>Bebasneue</option>
				</select>
			   <label>Font Size</label>
				<div style="height:100px;">
					<label id="fontsize_label"><?php echo $fontsize; ?></label>
					<input type="range" min="1" value="<?php echo $fontsize; ?>" name="fontsize" onchange="showFontSize(this.value)">
				</div>
				<label>Template</label>
				<select id="template" name="template" onchange="showExtraField(this.value)">
					<option value="none" <?php if($template == "none") echo "selected"; ?>>None</option>
					<option value="gradienth" <?php if($template == "gradienth") echo "selected"; ?>>Gradient-H</option>
					<option value="gradientv" <?php if($template == "gradientv") echo "selected"; ?>>Gradient-V</option>
					<option value="gradientr" <?php if($template == "gradientr") echo "selected"; ?>>Gradient-R</option>
					<option value="shadows" <?php if($template == "shadows") echo "selected"; ?>>Shadow-S</option>
					<option value="shadowl" <?php if($template == "shadowl") echo "selected"; ?>>Shadow-L</option>
					<option value="shadowsolids" <?php if($template == "shadowsolids") echo "selected"; ?>>Shadow-SolidS</option>
					<option value="shadowsolidl" <?php if($template == "shadowsolidl") echo "selected"; ?>>Shadow-SolidL</option>
					<option value="shadowstripe" <?php if($template == "shadowstripe") echo "selected"; ?>>Shadow-Stripe</option>
					<option value="outlinea" <?php if($template == "outlinea") echo "selected"; ?>>Outline-A</option>
					<option value="outlineb" <?php if($template == "outlineb") echo "selected"; ?>>Outline-B</option>
					<option value="outlined" <?php if($template == "outlined") echo "selected"; ?>>Outline-D</option>
					<option value="outlinetransparent" <?php if($template == "outlinetransparent") echo "selected"; ?>>Outline-Transparent</option>
					<option value="styleanimadow" <?php if($template == "styleanimadow") echo "selected"; ?>>Style-Animadow</option>
					<option value="styleapple" <?php if($template == "styleapple") echo "selected"; ?>>Style-Apple</option>
					<option value="stylebackwooa" <?php if($template == "stylebackwooa") echo "selected"; ?>>Style-BackwooA</option>
					<option value="stylebackwoob" <?php if($template == "stylebackwoob") echo "selected"; ?>>Style-BackwooB</option>
					<option value="stylebanner" <?php if($template == "stylebanner") echo "selected"; ?>>Style-Banner</option>
					<option value="stylebendient" <?php if($template == "stylebendient") echo "selected"; ?>>Style-Bendient</option>
					<option value="stylebevelg" <?php if($template == "stylebevelg") echo "selected"; ?>>Style-BevelG</option>

					<!-- new line -->

					
					
					
					
					
					
					
					
					
					
					
					<option value="stylebttf" <?php if($template == "stylebttf") echo "selected"; ?>>Style-BTTF</option>
					<option value="stylechocolate" <?php if($template == "stylechocolate") echo "selected"; ?>>Style-Chocolate</option>
					<option value="stylecolombia" <?php if($template == "stylecolombia") echo "selected"; ?>>Style-Colombia</option>
					<option value="stylecomic" <?php if($template == "stylecomic") echo "selected"; ?>>Style-Comic</option>
					<option value="styleconcaveb" <?php if($template == "styleconcaveb") echo "selected"; ?>>Style-ConcaveB</option>
					<option value="styleconcavebb" <?php if($template == "styleconcavebb") echo "selected"; ?>>Style-ConcaveBB</option>
					<option value="styleconcavet" <?php if($template == "styleconcavet") echo "selected"; ?>>Style-ConcaveT</option>
					<option value="styleconcavett" <?php if($template == "styleconcavett") echo "selected"; ?>>Style-ConcaveTT</option>
					<option value="stylecondense" <?php if($template == "stylecondense") echo "selected"; ?>>Style-Condense</option>
					<option value="stylecupadow" <?php if($template == "stylecupadow") echo "selected"; ?>>Style-Cupadow</option>
					<option value="styledragonb" <?php if($template == "styledragonb") echo "selected"; ?>>Style-DragonB</option>
					<option value="stylefrozen" <?php if($template == "stylefrozen") echo "selected"; ?>>Style-Frozen</option>
					<option value="stylegaldient" <?php if($template == "stylegaldient") echo "selected"; ?>>Style-Galdient</option>
					<option value="stylegermany" <?php if($template == "stylegermany") echo "selected"; ?>>Style-Germany</option>
					<option value="styleindianajones" <?php if($template == "styleindianajones") echo "selected"; ?>>Style-Indiana-Jones</option>
					<option value="stylekiss" <?php if($template == "stylekiss") echo "selected"; ?>>Style-KISS</option>
					<option value="stylemango" <?php if($template == "stylemango") echo "selected"; ?>>Style-Mango</option>
					<option value="stylemariadow" <?php if($template == "stylemariadow") echo "selected"; ?>>Style-Mariadow</option>
					<option value="stylemilky" <?php if($template == "stylemilky") echo "selected"; ?>>Style-Milky</option>
					<option value="styleminiadow" <?php if($template == "styleminiadow") echo "selected"; ?>>Style-Miniadow</option>
					<option value="styleminecraft" <?php if($template == "styleminecraft") echo "selected"; ?>>Style-Minecraft</option>
					<option value="stylenardient" <?php if($template == "stylenardient") echo "selected"; ?>>Style-Nardient</option>
					<option value="styleneon" <?php if($template == "styleneon") echo "selected"; ?>>Style-Neon</option>
					<option value="styleneonbeats" <?php if($template == "styleneonbeats") echo "selected"; ?>>Style-NeonBeats</option>
					<option value="styleneonoutline" <?php if($template == "styleneonoutline") echo "selected"; ?>>Style-NeonOutline</option>
					<option value="styleoblique" <?php if($template == "styleoblique") echo "selected"; ?>>Style-Oblique</option>
					<option value="styleobliquer" <?php if($template == "styleobliquer") echo "selected"; ?>>Style-ObliqueR</option>
					<option value="styleoutlinegb" <?php if($template == "styleoutlinegb") echo "selected"; ?>>Style-OutlineGB</option>
					<option value="styleoutlinetp" <?php if($template == "styleoutlinetp") echo "selected"; ?>>Style-OutlineTP</option>
					<option value="styleoutlineyb" <?php if($template == "styleoutlineyb") echo "selected"; ?>>Style-OutlineYB</option>
					<option value="styleoutlineultra" <?php if($template == "styleoutlineultra") echo "selected"; ?>>Style-OutlineUltra</option>
					<option value="stylepawp" <?php if($template == "stylepawp") echo "selected"; ?>>Style-PAWP</option>
					<option value="stylepokemon" <?php if($template == "stylepokemon") echo "selected"; ?>>Style-Pokemon</option>
					<option value="stylepolkadot" <?php if($template == "stylepolkadot") echo "selected"; ?>>Style-PolkaDot</option>
					<option value="stylepopstar" <?php if($template == "stylepopstar") echo "selected"; ?>>Style-Popstar</option>
					<option value="stylerobt" <?php if($template == "stylerobt") echo "selected"; ?>>Style-Robt</option>
					<option value="stylerotalic" <?php if($template == "stylerotalic") echo "selected"; ?>>Style-Rotalic</option>
					<option value="styleskew" <?php if($template == "styleskew") echo "selected"; ?>>Style-Skew</option>
					<option value="styleslant" <?php if($template == "styleslant") echo "selected"; ?>>Style-Slant</option>
					<option value="stylesmashb" <?php if($template == "stylesmashb") echo "selected"; ?>>Style-SmashB</option>
					<option value="stylespideroo" <?php if($template == "stylespideroo") echo "selected"; ?>>Style-Spideroo</option>
					<option value="stylesports" <?php if($template == "stylesports") echo "selected"; ?>>Style-Sports</option>
					<option value="stylestackedlines" <?php if($template == "stylestackedlines") echo "selected"; ?>>Style-StackedLines</option>
					<option value="stylestacked" <?php if($template == "stylestacked") echo "selected"; ?>>Style-Stacked</option>
					<option value="stylestamp" <?php if($template == "stylestamp") echo "selected"; ?>>Style-Stamp</option>
					<option value="stylestarstripes" <?php if($template == "stylestarstripes") echo "selected"; ?>>Style-StarStripes</option>
					<option value="stylestarw" <?php if($template == "stylestarw") echo "selected"; ?>>Style-StarW</option>
					<option value="styletoystory" <?php if($template == "styletoystory") echo "selected"; ?>>Style-ToyStory</option>
					<option value="styletwitch" <?php if($template == "styletwitch") echo "selected"; ?>>Style-Twitch</option>
					<option value="styletwitter" <?php if($template == "styletwitter") echo "selected"; ?>>Style-Twitter</option>
					<option value="shadowuniadow" <?php if($template == "shadowuniadow") echo "selected"; ?>>Style-Uniadow</option>
					<option value="stylewavy" <?php if($template == "stylewavy") echo "selected"; ?>>Style-Wavy</option>
					<option value="texturecloud" <?php if($template == "texturecloud") echo "selected"; ?>>Texture-Cloud</option>
					<option value="textureglittera" <?php if($template == "textureglittera") echo "selected"; ?>>Texture-Glitter-A</option>
					<option value="textureglitterb" <?php if($template == "textureglitterb") echo "selected"; ?>>Texture-Glitter-B</option>
					<option value="textureglitterc" <?php if($template == "textureglitterc") echo "selected"; ?>>Texture-Glitter-C</option>
					<option value="textureglitterd" <?php if($template == "textureglitterd") echo "selected"; ?>>Texture-Glitter-D</option>
					<option value="textureluxury" <?php if($template == "textureluxury") echo "selected"; ?>>Texture-Luxury</option>
					<option value="texturespacea" <?php if($template == "texturespacea") echo "selected"; ?>>Texture-Space-A</option>
					<option value="texturespaceb" <?php if($template == "texturespaceb") echo "selected"; ?>>Texture-Space-B</option>
					<option value="texturespacec" <?php if($template == "texturespacec") echo "selected"; ?>>Texture-Space-C</option>
					<option value="texturespaced" <?php if($template == "texturespaced") echo "selected"; ?>>Texture-Space-D</option>
					<option value="texturespace" <?php if($template == "texturespace") echo "selected"; ?>>Texture-Space</option>
					<option value="texturewaterblue" <?php if($template == "texturewaterblue") echo "selected"; ?>>Texture-Water-Blue</option>
					<option value="texturewaterpink" <?php if($template == "texturewaterpink") echo "selected"; ?>>Texture-Water-Pink</option>
					<option value="texturewatercolor" <?php if($template == "texturewatercolor") echo "selected"; ?>>Texture-Watercolor</option>
					<option value="loadlegacyeffect" <?php if($template == "loadlegacyeffect") echo "selected"; ?>>Load legacy effects</option>

				</select><br>
				<br>
				<select id="outlinesize" name="outline" class="disabled ">
					<option value="1"  <?php $outline = 1 ?> selected>X1</option>
					<option value="2" <?php $outline = 2 ?>>X2</option>
					<option value="3" <?php $outline = 3 ?>>X3</option>
					<option value="4" <?php $outline = 4 ?>>X4</option>
					<option value="5" <?php $outline = 5 ?>>X5</option>
					
				</select>
				
				<label>Font Color</label>
				<input type="color" name="fontcolor" value="<?php echo $fontcolor; ?>">
				<div id="gradientExtraOption" class="disabled extra-option">
					<label>Gradient Start Color</label>
					<input type="color" name="gradient_start" value="<?php echo $gradient_start; ?>">
					<label>Gradient End Color</label>
					<input type="color" name="gradient_end" value="<?php echo $gradient_end; ?>">
				</div>
				<div id="shadowExtraOption" class="disabled extra-option">
					<label>Shadow Color</label>
					<input type="color" name="shadow_color" value="<?php echo $shadow_color; ?>">
				</div>
				<div id="outlineExtraOption" class="disabled extra-option">
					<label>Outline Color</label>
					<input type="color" name="outline_color" value="<?php echo $outline_color; ?>">
				</div>
				<div id="styleExtraOption" class="disabled extra-option">
					<label>Style Color</label>
					<input type="color" name="style_color" value="<?php echo $style_color; ?>">
				</div>
				<button type="submit">Generate</button>
			</form>
		</div>
	</body>
	<script>
		function showFontSize(size) {
			document.getElementById("fontsize_label").innerHTML = size;
		}
		function showExtraField(value) {
			if(value == "gradienth" || value == "gradientv" || value == "gradientr" || value == "stylegaldient" ) {
				$(".active").removeClass("active");
				$("#gradientExtraOption").addClass("active");
			}else if(value == "shadows" || value == "shadowl" || value == "shadowsolids" || value == "shadowsolidl" || value == "shadowstripe" || value == "stylespideroo" || value == "stylefrozen" ) {
				$(".active").removeClass("active");
				$("#shadowExtraOption").addClass("active");
			}else if(value == "styleanimadow" || value == "stylebackwooa" || value == "stylebackwoob" || value == "stylebanner" || value == "stylebendient") {
				$(".active").removeClass("active");
				$("#styleExtraOption").addClass("active");
			}
			else if( value == "textureglittera"  || value == "styleoutlinetp"  || value == "styleneonoutline"  || value == "stylenardient" || value == "styleminiadow" || value == "stylemariadow" || value == "stylecupadow"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
			}
			else if(value == "texturewaterpink"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturewatercolor"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturewaterblue"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturespace"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturespaced"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturespacec"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturespaceb"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturespacea"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}

			else if(value == "textureluxury"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "textureglitterd"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "textureglitterc"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "textureglitterb"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "texturecloud"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "styleneonbeats"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "styleminecraft"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "outlinea"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "outlineb"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "outlined"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			else if(value == "outlinetransparent"){
				$(".active").removeClass("active");
				$("#outlineExtraOption").addClass("active");
				$("#outlinesize").addClass("active");
			}
			

			
		}
	</script>
</html>