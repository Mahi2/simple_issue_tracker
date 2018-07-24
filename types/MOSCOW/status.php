<?php
    if ( $values['status'] == 'Must have'  ) { $css = 'orange pulse'; }
elseif ( $values['status'] == 'Should have') { $css = 'green';        }
elseif ( $values['status'] == 'Could have' ) { $css = 'blue';         }
elseif ( $values['status'] == "Won't have" ) { $css = 'indigo';       }
elseif ( $values['status'] == 'Ready'      ) { $css = 'black';        }
