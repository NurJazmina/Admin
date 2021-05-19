<?php

                        $varmaps = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15935.288164121743!2d101.6954547!3d3.1416399000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc37d197ea7fdf%3A0x3790d8523745f1a8!2sMasjid%20Asy-Syakirin%20KLCC!5e0!3m2!1sen!2smy!4v1621390098905!5m2!1sen!2smy" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

                        list($maps1, $maps2) = explode("pb", $varmaps);
                        list($maps3, $maps4) = explode(" ", $maps2);
                        $mapsA = '<iframe src="https://www.google.com/maps/embed?pb';
                        $mapsB = ' width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
                        $eventmaps = $mapsA.$maps3.$mapsB;
                        echo $eventmaps;
?>