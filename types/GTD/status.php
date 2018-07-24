<?php
    if ( $values['status'] == 'In'            ) { $css = 'orange pulse'; }
elseif ( $values['status'] == 'Next actions'  ) { $css = 'green';        }
elseif ( $values['status'] == 'Waiting for'   ) { $css = 'blue';         }
elseif ( $values['status'] == 'Project'       ) { $css = 'teal';         }
elseif ( $values['status'] == 'Some day/maybe') { $css = 'indigo';       }
elseif ( $values['status'] == 'DONE'          ) { $css = 'black';        }
