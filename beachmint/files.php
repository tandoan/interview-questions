<?php
/**
Create a php program that handles class "acme" that represents files and folders. The main objects are files & folders.

Implement interface for file listing of files and folders (listing a folder will list items in it)
Implement interfaces for delete method between files & folder. The delete for folder will delete recursively (implementation should be recursive for this delete).


Create exception for nonexistence of a file/folder, permission.
Create unit test to handle delete and file listing.

*/

class file {
	private $name;
}

class folder {
	private $files = array();
}
class acme {
	public $files;
	public $folders;
}

interface listable{

}
interface deletable {

}

class DoesNotExistException extends Exception{}
class IncorrectPermissionsException extends Exception{}
