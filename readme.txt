Randy is little PHP script to rotate ads, text snippets, images, web pages, links or anything else that you want to rotate randomly. Randy reads an external file, picks a few random lines from it then inserts those lines into a web page at the point where randy.php is called to use. This was initially written to display text ads in random order but can easily display any HTML content.

I've used Randy to display

    Random hyperlinks
    Random images in a gallery
    Random tube clips
    Random user reviews
    Random ads
    Random text snippets
    and more...

Features

    Random display of data stored within a data file
    Display of mapped companion data alongside the data chosen randomly from the primary input data file.
    Data is displayed within an HTML table.
    The number of columns to display the data within can be configured
    The number of data items to retrieve can be configured
    Per item CSS classes e.g. class="randy-1" and class="randy-companion-1"
    Randy os easy to use.

Instructions

    Download the script (randy.php)
    Upload it to your server
    Unzip it
    Enter the Randy directory and edit the configs in randy.php
    Add data to data.txt
    Add data to companion.txt (optional)
    Call the script into your web page

When editing data.txt, put each item of data on its own line within. There must be no empty lines. You can use HTML if you want to.

Include Randy in your webpage with a PHP include like this:

<?php include("/path-to-randy/randy.php"); ?>

Styling

Content is displayed within a table which may be styled with CSS. The table has the ID of "randy" and the table data has the class of "randy" + the 'data's ordinal number' e.g class="randy-1" and class="randy-companion-1".

More Info

Read more at https://journalxtra.com/scripts/free-php-random-rotation-script/