<?php
// config.php
// configuration settings for amazon album image extractor
// NOTE: you WILL need to update/provide these settings - please refer to http://magnetikonline.com/fetchalbumart/ for further information



define('AMAZON_ACCESSKEY','xxxxxxxxxxxxxxxxxxxx');
define('AMAZON_SECRETKEY','xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

define('IMAGEMAGICK_CONVERT','"C:\\Program Files\\ImageMagick\\convert.exe"');
define('IMAGEMAGICK_SAVE_QUALITY',80);
define('TEMP_IMAGE_PATH','tmpimage.jpg');

define('TARGETIMAGE_FILENAME','cover.jpg');
define('TARGETIMAGE_WIDTH',300);
define('TARGETIMAGE_HEIGHT',300);

define('LOG_FILE','log.txt');
define('LOGERROR_FILE','logerror.txt');



class extractartistalbum {

	// album folder format variations:
	// # [Artist name] - [Album name]
	// # [Artist name] - [Album name] (Disc X)
	// # VA - [Artist name] - [Album name]
	// # VA - [Artist name] - [Album name] (Disc X)

	public function extract($inputalbumpath) {

		$basename = basename($inputalbumpath);

		// remove possible 'VA -' from the front of album folder
		$basename = str_replace('VA - ','',$basename);

		// split into album/artist
		if (preg_match('/^([^\-]+) - (.+)$/',$basename,$matches)) {
			$artistname = $matches[1];

			// rip out anything off the end of the album name that is brackets (e.g. (Disc 1))
			$albumname = $matches[2];
			$albumname = preg_replace('/\(.+\)$/','',$albumname);

			// return artist and album name
			return array($artistname,$albumname);
		}

		// unable to extract artist/album name
		return array();
	}
}
