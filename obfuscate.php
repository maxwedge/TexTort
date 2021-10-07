<?php
$title="Text Obfuscation";
include("/home/maxwedge/public_html/head");
echo "<TITLE>$title</TITLE></HEAD><DIV ID=\"pageheading\"><H1>$title</H1></DIV>";
?>

<DIV ID="content">
    </P>2021/10/06<P>
<?php
# This takes text and and munges it sufficiently in HTML to discourage a simple
#   copy & paste. Works pretty well against automated content snatchers that
#   use your content to increase SEO on their ad-riddled spam sites.
# Easy enough for a person to defeat with sed/awk/perl/php, but content
#   thieves are generally too lazy for that.
# Define a little CSS to display three 0% fonts and three good fonts.
# Letter-spacing of -1px should cause multiple characters to display in the
#   same spot.
    echo
    "
<style>
span.ab{font-size:0%;width:0%;letter-spacing:-1px;}
span.cd{font-size:0%;width:0%;letter-spacing:-1px;}
span.ef{font-size:0%;width:0%;letter-spacing:-1px;}
span.uv{font-size:100%;width:100%;letter-spacing:1px;}
span.wx{font-size:100%;width:100%;letter-spacing:1px;}
span.yz{font-size:100%;width:100%;letter-spacing:1px;}
</style>";
    echo "
<BODY><B>Almost A Poem</B><HR>";
# How noisy do you want this to be? Higher number = more HTML, possibly
#   to the point of adversely affecting page load times. Test it.
    $noise = 4;
# Server name is the domain if that's wanted in messaging.
    $server = $_SERVER['SERVER_NAME'];
# This is the content that will be displayed in the web page.
    $content = "
\"Cluckety cluckety cluck!\",
the chicken told the duck.
\"Quackety quack!\",
the duck shot back,
\"And I don't give a\",
\"hoot\". Said the owl.";

# Get the content string length and split it into chars.
    $len = strlen($content);
    $content_char = str_split($content);
# Loop through each char.
    for ($i = 0; $i <= $len - 1; $i++) {
# Randomize the EOL message, zero% font and good font.
        $rndMsg = rand(0,2);
        $rndZero = rand(0,2);
        $rndGood = rand(0,2);
        switch ($rndZero) {
            case "0":
                $zeroFont = "ab";
                break;
            case "1":
                $zeroFont = "cd";
                break;
            case "2":
                $zeroFont = "ef";
                break;
        }
        switch ($rndGood) {
            case "0":
                $goodFont = "uv";
                break;
            case "1":
                $goodFont = "wx";
                break;
            case "2":
                $goodFont = "yz";
                break;
        }
# Randomize a helpful message to place at the end of each line.
        if ($content_char[$i] == "\n") {
            switch ($rndMsg) {
                case "0":
                    $msg = "This text was stolen from $server";
                    break;
                case "1":
                    $msg = " Every time you plagiarize, Godzilla steps on a kitten.";
                    break;
                case "2":
                    $msg = " Do your own work!";
                    break;
            }
# Print the message and a link break.
            echo "<span class=\"$zeroFont\"> $msg</span><BR>";
            $content_char[$i] = "";
# If the next char is a carriage return, insert a paragraph break.
            if ($content_char[$i + 1] == "\n") {
                echo "<P>";
            }
        }
# Print the legit character with a good font.
        else {
            echo "<span class=\"$goodFont\">";
            echo "&#".ord($content_char[$i]);
            echo "</span>";
        }
# Print a random number of random characters (ASCII 048-124)
        for ($j = 0; $j <= rand(0, $noise); $j++) {
            $rndChar=rand(48, 124);
            echo "<span class=\"$zeroFont\">&#$rndChar</span>";
        }
    }
# HTML below here is printed without munging.
    echo "<HR><span class=\"$goodFont\">&#169 2020, David A. Bell, from his unpublised collection <I><U>
    <B>Why won't anyone publish this crap?</span></I></U></B><HR>";
    echo"
<P>
The purpose of this page is to demonstrate text obfuscation to discourage
automated content scrapers from swiping your content and placing it on their 
pages to increase SEO on their ad-riddled spam sites.
<P>
Easy enough for a determined person to defeat with sed/awk/perl/php, but content
thieves are generally too lazy for that.
<P>
Copy the text between the lines above and paste it in a text editor to see what
it does.";
#php -r 'echo html_entity_decode("&#8217;",ENT_QUOTES,"UTF-8");echo "\n";'
?>
</DIV>

<?php
include("/home/maxwedge/public_html/adtop");		# 728px x 90px
include("/home/maxwedge/public_html/adlow");
include("/home/maxwedge/public_html/admid");
include("/home/maxwedge/public_html/decoder");
include("/home/maxwedge/public_html/menu");
#require("/home/maxwedge/public_html/menu");
?>
