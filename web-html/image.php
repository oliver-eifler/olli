<?php
$html = "blablabla@img src='/images/logo.jpg'@ aslkdfkdslf sdlkfsdklfj @img src='/images/bla/test.jpeg'@ /imAges/bla/test.GIF";
$regex = "%/?images/(.*?)\.(jpe?g|png|gif|svg)%i";

echo "<code>".preg_replace_callback(
            $regex,
            "image_name",
            $html)."</code>";
exit(0);
function image_name($matches)
{
    print_r($matches);
    return $matches[1].".".$matches[2];
}
$result = preg_replace_callback('%/images/(.*).(gif|jpg|bla)%', 'compute_replacement', $subject);




?>