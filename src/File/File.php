<?php
/**
 * @package      Prism
 * @subpackage   Files
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Prism\Library\File;

use Joomla\CMS\Filesystem\File as JoomlaFile;
use Joomla\CMS\Filesystem\Path;
use Joomla\CMS\Image\Image;

/**
 * This class provides functionality for uploading files and
 * validates the process.
 *
 * @package      Prism
 * @subpackage   Files
 */
class File
{
    protected $file;
    protected $fileData = array();

    /**
     * Initialize the object.
     *
     * <code>
     * $myFile   = "/tmp/myfile.txt";
     *
     * $file = new Prism\Library\File\File($myFile);
     * </code>
     *
     * @param  mixed $file
     *
     * @throws \UnexpectedValueException
     */
    public function __construct($file)
    {
        $this->file = Path::clean($file);
    }

    /**
     * Check if the file name has extension of an image.
     *
     * <code>
     * $filePath = '/tmp/picture1.png';
     * $file     = new Prism\Library\File\File($filePath);
     *
     * if ($file->isImage()) {
     * // ...
     * }
     * </code>
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function isImage()
    {
        // Check file extension and its mime type.
        return ($this->hasImageExtension() and $this->hasImageMime());
    }

    /**
     * Check if file is a video.
     *
     * <code>
     * $filePath = '/tmp/video.avi';
     * $file     = new Prism\Library\File\File($filePath);
     *
     * if ($file->isVideo()) {
     * // ...
     * }
     * </code>
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return bool
     * @todo Under construction.
     */
    public function isVideo()
    {
        // Check file extension and its mime type.
        return false;
    }

    /**
     * Check if the file name has extension of an image.
     *
     * <code>
     * $filePath = '/tmp/picture1.png';
     * $file     = new Prism\Library\File\File($filePath);
     *
     * $filetype = $file->getFiletype()
     * </code>
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function getFiletype()
    {
        $filetype = '';
        if ($this->isImage()) {
            $filetype = 'image';
        } elseif ($this->isVideo()) {
            $filetype = 'video';
        }

        return $filetype;
    }

    /**
     * Extract information about file using PHP Fileinfo.
     *
     * <code>
     * $filePath = '/tmp/picture1.png';
     * $file     = new Prism\Library\File\File($filePath);
     *
     * $fileData = $file->extractFileData();
     * </code>
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function extractFileData()
    {
        // Get mime type.
        if (function_exists('finfo_open')) {
            $finfo        = finfo_open(FILEINFO_MIME_TYPE);
            $this->fileData['mime'] = finfo_file($finfo, $this->file);
            finfo_close($finfo);
        }

        $this->fileData['filename']  = basename($this->file);
        $this->fileData['filesize']  = filesize($this->file);
        $this->fileData['filetype']  = $this->getFiletype();
        $this->fileData['extension'] = JoomlaFile::getExt(basename($this->fileData['filename']));

        if ($this->isImage()) {
            $imageProperties = Image::getImageFileProperties($this->file);

            $this->fileData['attributes'] = array(
                'type'   => $imageProperties->type,
                'width'  => $imageProperties->width,
                'height' => $imageProperties->height
            );
        }

        return $this->fileData;
    }

    /**
     * Check if the file name has extension of an image.
     *
     * <code>
     * $filePath = '/tmp/picture1.png';
     * $file     = new Prism\Library\File\File($filePath);
     *
     * if ($file->hasImageExtension()) {
     * // ...
     * }
     * </code>
     *
     * @return bool
     */
    public function hasImageExtension()
    {
        $extensions     = ['jpg', 'jpeg', 'bmp', 'gif', 'png'];
        $fileExtension  = JoomlaFile::getExt(basename($this->file));

        return (($fileExtension !== null && $fileExtension !== '') && in_array($fileExtension, $extensions, true));
    }

    /**
     * Check if a mime type is an image.
     *
     * <code>
     * $filePath = '/tmp/picture1.png';
     * $file     = new Prism\Library\File\File($filePath);
     *
     * if ($file->hasImageMime()) {
     * // ...
     * }
     * </code>
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     *
     * @return bool
     */
    public function hasImageMime()
    {
        $result = false;

        if (function_exists('gd_info') && extension_loaded('gd')) {
            $mimeTypes     = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/bmp', 'image/x-windows-bmp'];

            if (count($this->fileData) > 0) {
                $mimeType = $this->fileData['mime'];
            } else {
                $imageProperties = Image::getImageFileProperties($this->file);
                $mimeType = $imageProperties->mime;
            }

            if (in_array($mimeType, $mimeTypes, true)) {
                $result = true;
            }
        }

        return $result;
    }
}
