<?php

/**
 *
 * BUGGY Deadline... (EDIT MODUL)
 * ------------------------------
 *
 * Alle rights reserved - (c) 2018 mahid_hm
 *
 */


// START & CONFIG
ob_start(); 
require 'setup/config.php';

// SET LANGUAGE
if ( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) and
     file_exists('lang/'.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'.php') 
   ) {
   @include_once('lang/'.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'.php');
} else {    
  @include_once('lang/'.$LANG.'.php');
}

// INI VARs
$file = 'data/'.$TYPE.'.json'; // DATA FILE NAME

// LOGIN CHECK
session_start(); 
$sessionname = md5($USER.$SALT);
if(!@$_SESSION[$sessionname]){ 
    header('location: login.php'); 
    exit; 
}

// READ DATA
$jsonString = file_get_contents( $file );
$data = json_decode( $jsonString, true );

// GENERATE LIST FOR DATA-LIST IN NAME INPUT FIELD
foreach ( $data as $key => $values ) {
  $list .= '<option value="'.$values['name'].'">';
}

// DEFAULT DATE IF NOT SET
if ( $data[@$_GET['id']]['date'] == '' ) {
  $data[@$_GET['id']]['date'] = date( $DATE );
}

// SAVE NEW ENTRY IF FORM POSTED
if ( $_SERVER['REQUEST_METHOD'] == 'POST' and
     @$_POST['name'] != '' and
     @$_POST['text'] != '' and
     @$_POST['status'] != '' ) {
	$jsonString = file_get_contents( $file );
	$data = json_decode( $jsonString, true );
	foreach ( $data as $key => $entry ) {
		if ( $key == $_GET['id'] ) {
			$data[$key]['date']   = $_POST['date'];
			$data[$key]['name']   = $_POST['name'];
			$data[$key]['text']   = $_POST['text'];
			$data[$key]['status'] = $_POST['status'];
		}
	}
	$newJsonString = json_encode( $data );
	file_put_contents( $file, $newJsonString );
	header( 'location: index.php?msg='.$i18n['Entry successfully edited!'] );
} else if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$_GET['msg'] = $i18n['All fields are required!'];
}

// HEADER
ob_end_flush();	
include 'tpl/header.php';

// FORM FOR EDIT ENTRY
?>
<div class="badge grey lighten-3 hoverable" style="padding:1em">
  <h3 class="grey-text text-darken-2"><?php echo $i18n['Edit Issue']; ?></h3>
  <form method="POST">
    <div class="row">
      <div class="input-field col s4">
        <input 
          value="<?php echo $data[@$_GET['id']]['date']; ?>" 
          id="date" 
          name="date" 
          type="text" 
          class="datepicker" 
          maxlength="<?php strlen($PICK); ?>" 
          data-length="<?php strlen($PICK); ?>" 
          required="required" 
          placeholder="<?php echo $data[@$_GET['id']]['date']; ?>"
        >
        <label class="active" for="date"><?php echo $i18n['Date']; ?></label>
        <span class="helper-text" data-error="Error" data-success="OK">
          <?php echo $i18n['Creation date or deadline!']; ?>
        </span>
      </div>
      <div class="input-field col s8">
        <input 
          value="<?php echo $data[@$_GET['id']]['name']; ?>" 
          id="name" 
          name="name" 
          type="text" 
          class="validate" 
          maxlength="32" 
          data-length="32" 
          required="required" 
          autocomplete="off"
          list="list" 
          placeholder="<?php echo $data[@$_GET['id']]['name']; ?>"
        >
        <datalist id="list">
          <?php echo $list; ?>
        </datalist>
        <label class="active" for="name"><?php echo $i18n['Name']; ?></label>
        <span class="helper-text" data-error="Error" data-success="OK">
          <?php echo $i18n['Quick summary or projectname.']; ?>
        </span>
      </div>
      <div class="input-field col s12">
        <textarea 
          id="text" 
          name="text" 
          class="materialize-textarea validate" 
          maxlength="128" 
          data-length="128" 
          required="required" 
          placeholder="<?php echo $data[@$_GET['id']]['text']; ?>"
        ><?php echo $data[@$_GET['id']]['text']; ?></textarea>
        <label class="active" for="text"><?php echo $i18n['Text']; ?></label>
        <span class="helper-text" data-error="Error" data-success="OK">
          <?php echo $i18n['Describe the issue in detail.']; ?>
        </span>
      </div>
      <div class="input-field col s12">
        <select name="status" id="status">
          <option selected><?php echo $data[@$_GET['id']]['status'];?></option>
          <option value="" disabled><?php echo $i18n['Choose']; ?></option>
          <?php require 'types/'.$TYPE.'/status.txt'; ?>
        </select>
        <label for="status"><?php echo $i18n['Label']; ?></label>
        <span class="helper-text" data-error="Error" data-success="OK">
          <?php echo $i18n['Select one label.']; ?>
        </span>
      </div>
    </div>
    <button class="black btn waves-effect waves-light" type="submit" name="action">
      <?php echo $i18n['Save Issue']; ?>
      <i class="material-icons right">save</i>
    </button>
    </form>
</div>
<br>
<?php

// FOOTER
include 'tpl/footer.php';
