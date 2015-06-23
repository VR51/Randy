<?php

/*
Randy V1.1.1

Copyright Lee Hodson, 2011, http://journalxtra.com

Donations welcome via PayPal. Use the donate button at JournalXtra.com. Thank you :D

LICENSE

0, This license relates to ALL versions of Randy, derivative works, forks and its (or their) inclusion within other works. For the purposes of this license, the word "script" implies "Randy" the term "author" implies "Lee Hodson".
1, This script is free to use.
2, You may employ this script for any purpose.
3, The author is not responsible for any negative consequences.
4, The author is not responsible for the way it is employed.
5, You may share this script but this license must remain.
5b, When  sharing this script, this license and everything above it (including the author's details) must remain intact whether the script is shared in its entirety or shared as a derivative or fork of itself or a partitive work of a larger script.
6. This script may be used for commercial purposes.
7, The author of this script welcomes donations (visit http://journalxtra.com to send donations or contact the script's author).

ABOUT

Randy reads lines of data (henceforth called "strings") contained within a specified file then redisplays a specified number of those strings in random order. For example, if the datafile contains 100 strings and you want Randy to randomly display 10 of those strings each time Randy is called by a webpage then set $show to "10".

Randy can display the data in either tabular or non-tabular format. To create a table, configure $per_row to set the number of columns.

This script is ideal for displaying random ads, text and links within webpages.

Randy can even display companion data to the primary data. This is useful when one wishes to place textual information next to the main data.

More information and help with using this script is available at http://journalxtra.com/2010/06/free-php-random-rotation-script/

INSTRUCTIONS

1) Upload Randy to your web server
2) Unzip it
3) Enter the vr-randy directory
4) Edit randy.php to configure the script. User settings are between the tags "CONFIGS" and "END CONFIGS".
5) Edit data.txt. Place each set of data into a line of its own
6) (optional) edit companion.txt. Place each set of data into a line of its own
7) Include Randy in your webpage with a PHP include like this:

<?php include("/path-to-randy/randy.php"); ?>

STYLING

Content is displayed within a table which may be styled with CSS. The table has the ID of "randy" and the table data has the class of "randy" + the 'data's ordinal number' e.g class="randy-1" and class="randy-companion-1".

ERROR MESSAGES AND SOLUTIONS

Error message:	"failed to open steam <some directory path>/<file name>"
Cause:		Randy is unable to locate the datafile/s specified in $file and/or $companion
Solution: 	Do not set $dpath (under advanced configurations). Instead, specify the relative file directory paths with the file names.
		Do not place a forward slash before the file path.
		Do not place a forward slash after the file name..

CHANGE LOG


1.1.1	2015

* Minor changes
* Apended item number to HTML class
* Added item count file content autopopulation feature for the companion file.
* Various other minor changes.

1.1.0	First public release in 2011

0.0.0	Year of birth: 2010

*/

#### CONFIGS

$title = ''; # (Optional) title to show above the content. Leave blank to disable. HTML Allowed. E.G Use <strong>TITLE</strong> for a bold title.
$file = 'data.txt'; # The file that contains the data to display randomly
$pre = ''; # (Optional) Whatever should display before all the random items are displayed
$post = ''; # (Optional) Whatever should display after all the random items are displayed
$infix = '&nbsp;'; # (Optional) Whatever should display between each random item. E.G Use <br /> for a new line or &nbsp; for a single space.
$show = ''; # The number of items to show from the data file. Leave empty to display all rows of data.
$per_row = '3'; # How many items per row? Effectively, this is the number of columns. Leave empty to display as defined by $pre, $post and $infix alone.

# If you use HTML for $pre, $post or $infix then be sure to escape any single quotes by inserting a single backslash in front of them e.g \"

#### ADVANCED CONFIGS

$companion = 'companion.txt'; # Would you like to use a companion data file? Perhaps you would like each item of data in $file to be accompanied by extra images or text. If so, place the accompanying data in a file and name it here. The companion file must contain the same number of data lines as data.txt otherwise companion.txt will be automatically appended with additional lines of data filled with whatever the value of $infill is set to.
$infill = 'use item number'; # Leave void to append empty new lines to the companion data file to bring its line count to the same value as for the main file ($file).
		# Set to 'use item number' populate the companion file with a numerical list of the data file's item count.

$dpath = ''; # The path to the datafiles relative to the page that calls randy.php. Leave empty if they are in the same directory as the calling page/s.

#### END CONFIGS



ini_set('auto_detect_line_endings', TRUE);

$file = $dpath.$file;
$companion = $dpath.$companion;
$disp = file($file, FILE_IGNORE_NEW_LINES);
$count = (count($disp)-1);
$show = ($show-1);
$rand = array();

if ($companion != '')
{
  $codata = file($companion, FILE_IGNORE_NEW_LINES);
  $ct = (count($codata)-1);
	if ($ct < $count);
	{
		$dif = ($count-$ct);
		if ( $infill == 'use item number' )
		{
			$d = 1;
			while ($d <= $dif+1)
			{
				$infill = $d;
				file_put_contents($companion,$infill."\n",FILE_APPEND);
				$d = $d+1;
			}
		}

		if ( $infill == '' )
		{
			for ($d=1;$d<=($dif+1);$d++) {
				file_put_contents($companion,$infill."\n",FILE_APPEND);
			}
		}
	}
}

if (!$per_row <> '0')
{
	$per_row = 0;
}

if (($show >= $count) | ($show < 0))
{
  $show = $count;
}

for ($a=0;$a<=$count;$a++) {array_push($rand,$a);} shuffle($rand); # Creates an array of keys then shuffles them

echo $title;

echo $pre;

if ($per_row !=0)
{

  echo '<table id="randy">';
  $col_ent = array();

  $i = 0;
  while ($i <= $show)
  {
    $key = $rand[$i];
    array_push($col_ent,'1');

    if (count($col_ent) == 1)
    {
    echo '<tr>';
    }
    echo "<td class='randy-$i'>";
    echo $infix.$disp[$key].$infix;
      if ($companion != '')
      {
      echo '</td>';
      echo "<td class='randy-companion-$i'>";
      echo $infix.$codata[$key].$infix;
      }
    $i++;
    echo '</td>';

    if (count($col_ent) == $per_row)
    {
    echo '</tr>';
    unset($col_ent);
    $col_ent = array();
    }
  }

  if (count($col_ent) == 0)
  {
  echo '</table>';
  } else
  {
  echo '</tr></table>';
  }

}

if ($per_row == 0)
{
  $i = 0;
  while ($i <= $show)
  {
    $key = $rand[$i];
    echo $infix.$disp[$key];
      if ($companion <> '')
      {
      echo $infix.$codata[$key];
      }
    $i++;
  }
}

echo $post;

?>