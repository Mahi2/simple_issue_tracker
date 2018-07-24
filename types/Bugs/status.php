<?php
    if ( $values['status'] == 'Critical') { $css = 'orange pulse'; }
elseif ( $values['status'] == 'High'    ) { $css = 'green';        }
elseif ( $values['status'] == 'Normal'  ) { $css = 'blue';         }
elseif ( $values['status'] == 'Low'     ) { $css = 'indigo'        }
elseif ( $values['status'] == 'Ready'   ) { $css = 'black';        }
