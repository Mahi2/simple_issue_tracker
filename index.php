<?php

/**
 * BUGGY Deadline...
 * -----------------
 *
 * A simple, single Person Bug and Issue Tracker also for MoSCoW-Method
 * This is a solo developer focused tracking tool.
 * It has a modern UI making a very fluid user experience.
 * It is designed to work without database, on cheap webspace or
 * 100% offline e.g. on localhost, so it is very fast.
 * Using it should be as simple as copying the script code.
 * To run simply edit the config and start the index file. 
 *
 * Alle rights reserved - (c) 2018 mahid_hm
 */

// DISPLAY ALL ERRORS
error_reporting(E_ALL);
ini_set('display_errors', 1);

// FOR DEBUG ONLY
if ( isset($_GET['php']) and $_GET['php'] == 'info' ) { die( phpinfo() ); }

// SEARCH HELPER FUNCTION
function contains(array $array, $string) {
  $count = 0;
  foreach ( $array as $value ) {
    if ( false !== stripos($string, $value) ) {
      ++$count;
    }
  }
  return $count == count($array);
}

// START & CONFIG
ob_start(); 
require 'setup/config.php';

// SET LANGUAGE
if ( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) and
     file_exists('lang/'.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'.php') ) {
   @include_once('lang/'.substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2).'.php');
} else {    
  @include_once('lang/'.$LANG.'.php');
}

// INI VARs
$found = 0;                     // MARKER HOW MANY HITS FOUND A SEARCH
$done  = 0;                     // MARKER HOW MANY ENTRYs ARE DONE
$msg   = '';                    // TOAST MESSAGE
$file  = 'data/'.$TYPE.'.json'; // DATA FILE NAME

// LOGIN CHECK
session_start();
$sessionname = md5($USER.$SALT);
if(!@$_SESSION[$sessionname]){ 
    header('location: login.php'); 
    exit; 
}

// DELETE ENTRY IF DEL LINK IS CLICKED
if ( @$_GET['delete_id'] != '' ) {
	$data = json_decode( file_get_contents( $file ), true );
	unset( $data[@$_GET['delete_id']] );
	$convert_array_to_json = array_values( $data );
	$write_json = json_encode( $convert_array_to_json );
	file_put_contents( $file, $write_json );
	header('location: index.php?msg='.$i18n['Entry successfully deleted.']);
}

// DEFAULT DATE IF NOT SET
if ( @$_POST['date'] == '' ) {
  $_POST['date'] = date( $DATE );
}

// SAVE NEW ENTRY IF FORM POSTED
if ( $_SERVER['REQUEST_METHOD'] == 'POST' and
     @$_POST['name'] != '' and
     @$_POST['text'] != '' and
     @$_POST['status'] != ''
   ) {
	$formdata = array(
	  'id' => time(), 'name' => $_POST['name'], 'text' => $_POST['text'],
    'status' => $_POST['status'], 'date' => $_POST['date'],
  );
	$arr_data = array(); 
	if(file_exists($file)) {
		$jsondata = file_get_contents($file);
		$arr_data = json_decode($jsondata, true);
	}
	$arr_data[] = $formdata;
	$jsondata = json_encode($arr_data);
	if(file_put_contents($file, $jsondata)) {
		$msg = $i18n['Data successfully saved!'];
	} else {
		$msg = $i18n['ERROR &mdash; Data not saved!'];
	}
	header( 'location: index.php?msg='.$msg );
}else if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$_GET['msg'] = $i18n['All fields are required!'];
}

// CREATE DATA FILE IF NOT EXISTS
if(!is_file($file)){
  file_put_contents($file, '');
}

// READ DATA
$data = json_decode( file_get_contents( $file ), true );
# var_dump( $data );

// HEADER
ob_end_flush();	
include 'tpl/header.php';

// FORM FOR NEW ENTRY
if ( @$_GET['q'] == '' ) {
?>
<div class="badge grey lighten-3 hoverable" style="padding:1em">
  <h3 class="grey-text text-darken-2"><?php echo $i18n['New Issue']; ?></h3>
  <form method="POST">
    <div class="row">
      <div class="input-field col s4">
        <input 
          value="<?php echo date($DATE);?>" 
          id="date" 
          name="date" 
          type="text" 
          class="datepicker" 
          maxlength="<?php strlen($PICK); ?>" 
          data-length="<?php strlen($PICK); ?>" required="required"
        >
        <label for="date"><?php echo $i18n['Date']; ?></label>
        <span class="helper-text" data-error="Error" data-success="OK">
          <?php echo $i18n['Creation date or deadline!']; ?>
        </span>
      </div>
      <div class="input-field col s8">
        <input 
          value="<?php echo @$_POST['name'];?>" 
          id="name" 
          name="name" 
          type="text" 
          class="validate" 
          maxlength="32" 
          data-length="32" 
          required="required" 
          autocomplete="off"
          list="list"
        >
        <datalist id="list">
          <?php foreach ( $data as $key => $values ) {
            echo '<option value="'.$values['name'].'">';
          } ?>
        </datalist>
        <label for="name"><?php echo $i18n['Name']; ?></label>
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
        ><?php echo @$_POST['text'];?></textarea>
        <label for="text"><?php echo $i18n['Text']; ?></label>
        <span class="helper-text" data-error="Error" data-success="OK">
          <?php echo $i18n['Describe the issue in detail.']; ?>
        </span>
      </div>
      <div class="input-field col s12">
        <select name="status" id="status">
          <?php if(@$_POST['status']!='')echo '<option>'.$_POST['status'].'</option>';?>
          <option value=""><?php echo $i18n['Choose']; ?></option>
          <?php require 'types/'.$TYPE.'/status.txt'; ?>
        </select>
        <label for="status"><?php echo $i18n['Label']; ?></label>
        <span class="helper-text" data-error="Error" data-success="OK">
          <?php echo $i18n['Select one label.']; ?>
        </span>
      </div>
    </div>
    <button class="black btn waves-effect waves-light" type="submit" name="action">
      <?php echo $i18n['Save New Issue']; ?>
      <i class="material-icons right">add_circle_outline</i>
    </button>
  </form>
</div>
<br>
<?php

// SEARCH HEADER
}else{ 
  echo '<div class="badge grey lighten-3 hoverable" style="padding:1em">
        <h3 class="grey-text text-darken-2">'.$i18n['Search for'].' [&nbsp;'.
        htmlentities($_GET['q']).'&nbsp;]</h3></div><br>';
  $searchArray = explode(' ', $_GET['q']);
}

// DATA TABLE
if ( !empty( $data ) ) {
  
  // TABLE HEADER
  $table = '
  <table class="striped responsive-table hoverable tablesorter" id="table">
  <thead>
  <tr>
  <th>'.$i18n['ID'].'</th>
  <th>'.$i18n['Date'].'</th>
  <th>'.$i18n['Name'].'</th>
  <th>'.$i18n['Text'].'</th>
  <th>'.$i18n['Label'].'</th>
  <th style="text-align:center">'.$i18n['Action'].'</th>
  </tr>
  </thead>
  <tbody>
  ';
  
  // LOOP EACH ENTRY
  foreach( $data as $key => $values ) {

    // CHECK SEARCH
    $dataLine = $values['date'].' '.$values['name'].' '.$values['text'].' '.$values['status'];
    if ( @$_GET['q'] != '' AND contains($searchArray, $dataLine) != count($searchArray) ) {
      continue;
    }else{
      $found = 1;
    }

    // SET TABLE LINE
    $css = '';
    require 'types/'.$TYPE.'/status.php';
    $toast = 'M.toast({html: "<span>'.$values['name'].'</span>'.
             '<a href=?delete_id='.$key.' class=toast-action>'.
             $i18n['DELETE'].'</a> &nbsp; &nbsp;"});';
    $table .= '<tr><td style="padding-left:20px">'.$values['id'].
              '</td><td style="padding-left:20px">'.$values['date'];

    // CHECK IF DATE IS REACHED AND ENTRY IS NOT DONE OR Ready
    if ( $values['date'] <= date($DATE) AND
         $values['status'] != 'DONE' AND
         $values['status'] != 'Ready'
       ) {
        $table .= '<span style="margin-left:10px;font-size:1rem;min-width:22px;padding:2px"'.
                  ' class="new badge black pulse" data-badge-caption=""><i'.
                  ' class="material-icons tiny tooltipped" data-position="top"'.
                  ' data-tooltip="'.$i18n['Date reached!'].'">update</i></span>';
    }

    // ACTION BUTTONS (DEL & EDIT)
    $table .= '</td><td style="padding-left:20px">'.mb_strimwidth($values['name'],0,16,'...').
              '</td><td style="padding-left:20px">'.mb_strimwidth($values['text'],0,64,'...').
              '</td><td style="padding-left:20px"><span class="new badge '.$css.
              ' darken-1 white-text" data-badge-caption="">'.$values['status'].'</span></td>'.
              '<td style="text-align:center"><a class="tooltipped" data-position="top" '.
              'data-tooltip="'.$i18n['Click alert link for delete!'].'" '.
              'href="#" onclick=\''.$toast.'\'><i class="red-text text-darken-4 small '.
              'material-icons">delete_forever</i></a> <a class="tooltipped" '.
              'data-position="top" data-tooltip="'.$i18n['EDIT'].'" '.
              'href="edit.php?id='.$key.'"><i class="grey-text small '.
              'material-icons">mode_edit</i></a></td></tr>';

    // CALC FOR PROGRESS BAR   
    if ( $values['status'] == 'DONE' OR $values['status'] == 'Ready') {
      $done++; 
    }

  // END LOOP
  }
  
  // ECHO PROGRESS-BAR (only if there is no search performed) SEE tpl/css/progress.css
  if (@$_GET['q'] == '') {
    echo '<div class="progress tooltipped" data-position="top"'.
         ' data-tooltip="'.$done.'/'.count($data).' '.$TYPE.
         '" title="'.$done.'/'.count($data).' '.$TYPE.'">'.
         '<div class="progress-bar green" data-width="'.($done/count($data)*100).
         '" style="width:'.($done/count($data)*100).'%"></div></div>';
  }
  
  // SEARCH FOUND NO DATA
  if ( $found == 0 ) {  
    echo '<tr><td colspan="5"><h3 class="center grey-text text-darken-2">';
    echo $i18n['Nothing Found!'].'</h3></td></tr>';
  } else {

    // ECHO TABLE
    echo $table.'</tbody></table><br>';
  }

// ENDIF no data
}

// FOOTER
include 'tpl/footer.php';
