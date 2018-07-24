<!DOCTYPE html>
<html lang="<?php echo $LANG; ?>">
<head>
  <meta http-equiv="Content-Type" 
        content="text/html; charset=<?php echo $languageInfo[$LANG]['charset']; ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Todo Tracker&trade;</title>
  <link rel="stylesheet" href="tpl/css/font.css">
  <link rel="stylesheet" href="tpl/css/materialize.min.css">
  <link rel="stylesheet" href="tpl/css/tablesorter/style.css">
  <link rel="stylesheet" href="tpl/css/progress.css">
  <link rel="icon" type="image/png" href="data:image/png;base64, AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A2traLpOTk4b///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wCTk5OG2NjYMMHBwUw+Pj7w////AP///wD///8A8/PzDpmZmX67u7tUu7u7VJmZmX7z8/MO////AP///wD///8APj4+8MHBwUzt7e0VOTk597Ozs17///8A8vLyD1paWs0zMzP/rq6uZK6urmQzMzP/WlpazfLy8g////8As7OzXjk5Offt7e0V////AKenp2s2Njb6kpKShmhoaL0zMzP/MzMz/66urmSurq5kMzMz/zMzM/9oaGi9kpKShjY2Nvqnp6dr////AP///wD///8Avr6+UFFRUdczMzP/MzMz/zMzM/+urq5krq6uZDMzM/8zMzP/MzMz/1FRUde+vr5Q////AP///wDg4OAmzs7OPM7Ozjx5eXmnMzMz/zMzM/8zMzP/rq6uZK6urmQzMzP/MzMz/zMzM/95eXmnzs7OPM7Ozjzg4OAlUVFR2TMzM/8zMzP/MzMz/zMzM/8zMzP/MzMz/5GRkYmRkZGJMzMz/zMzM/8zMzP/MzMz/zMzM/8zMzP/T09P2////wD///8A////AF9fX8czMzP/MzMz/zMzM/82Njb6NjY2+jMzM/8zMzP/MzMz/2FhYcX///8A////AP///wD///8A////AMTExEc5OTn3Q0ND6JqamnzLy8s/3t7eKNra2i6+vr5QnZ2deUxMTOA5OTn3xMTER////wD///8A////APDw8BNERETpioqKkff39wqEhISYRERE6DQ0NPw0NDT8RERE6ISEhJj4+PgHkZGRiEREROnw8PAT////AP///wCoqKhrTExM3vv7+wOnp6dtMzMz/zMzM/8zMzP/MzMz/zMzM/8zMzP/p6enbfv7+wNMTEzeqKioa////wD///8AhISEmXl5eab///8AmZmZfjMzM/8zMzP/MzMz/zMzM/8zMzP/MzMz/5mZmX7///8AeXl5poSEhJn///8A////AHBwcLKkpKRx////AOPj4yJHR0flMzMz/zMzM/8zMzP/MzMz/0dHR+Xj4+Mi////AKGhoXRwcHCy////AP///wD29vYK/f39A////wD///8A8PDwEmZmZr0zMzP/MzMz/2ZmZr3w8PAS////AP///wD9/f0A9/f3Cv///wD///8A////AP///wD///8A////AP///wDi4uIlZGRkwWRkZMHi4uIl////AP///wD///8A////AP///wD///8A//8AAL/9AAC//QAAuZ0AAMGDAADhhwAA4YcAAAAAAADgBwAA5+cAAMgTAADYGwAAmBkAALgdAAD8PwAA/n8AAA">
</head>
<body>
  <div class="navbar-fixed">
    <nav class="black" role="navigation">
      <div class="nav-wrapper container">
        <a id="logo-container" href="./" 
           class="brand-logo grey-text text-lighten-2" style="left:2%">
          <img style="vertical-align:middle" title="Todo Tracker&trade;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwABEI8AARCPAbZ2bGgAAAAadEVYdFNvZnR3YXJlAFBhaW50Lk5FVCB2My41LjExR/NCNwAAAv9JREFUWEfllr1LVXEcxn0bBHEwXZSECMHBQQRdQhpcylmaHEsxEAqxcGkIh6aWEgIRiYTwH8gCcVMIkaQmIQraeiNIWnrv8xye37m/e8+5ek9xpx744D3P8/1+f+def+el4W+0t7fXDDPw2Ohzs+P6ioXEQ/hdgTxX1VEsMhotWsmoy4qL5kY4C522yuT8AuxD3uJCmWoa3VYm/E7QGtkcU/9HDdm1lQqvDTac14Jq29yeCm/X+YytkjAXHR7aSoW36qwIq25PhXfobNFWSZjzDn9Cq2357fDNWRG+Q7vHaE4raLayedslYU44FIO25fdFflH6PEZzBiN/wnZJmL1RwZxt+R2RX5QOj9GcucjvtV0ugrDDDyC9sfA5bJ4ipJuZz7pxaab8fdtZEU65SCzYlj8Mn6LsOFQ77Hb1L0TZlO2sCFvguQu1YbQxkw3J327QlfIUPkMYGJCnTDXd7tG94yqEzafZLcqqioJ++OgG8RZuwimXJOJYu/qESa8aieMuuAwvIMzRzH6XHC0KB+C1GwO/4BncgUtwHs6Yc3ARbsMO6BKMe1/BgMfXJhqWowH/yj2PrV00rVQMyeONyctiVjw2K8J10M+b13gU2linTdhkRdCa6zqBD5FZhAN/B80I13hR3qt5CK7B9QruQ15TYMfra4Y2Xl5NQLMq5+sSH/KIrAjjW3Me2y5V7XZFVkn+rbeaaOiBW3DUU7DWE9AMzepxeXVRpDvXFfgCecNiivwCQjM1O/dtSUPEXQgN2qVPoNoGq+UE1KsZ8VWmNdwZCTN+EKlxxP4IfLUfc9wJqCeeEX+R8gcSht75wv3/JXQ5SsTxtLOY405g2nEijvV80GxlWqv0zsjBpAMxbrtM+LPwI6qrdgKqmXVUJvzxqG7SdhKE+/47aLKdEdkYhIdU3gkoG7OdEVkTaA3VLttOgk2bW7aqiho9hvWoXbIlb8le2WM5T9RsgdbatJWYj2yu2aqbWOOB19qwlZh6870BJ23VTVrDa6VvzP+zGhr+AL6yO8FIRebTAAAAAElFTkSuQmCC" />
          <span class="hide-on-med-and-down small"><?php echo $TYPE; ?></span>
        </a>
        <ul class="right">
          <li>
            <a 
              href="./logout.php" 
              class="tooltipped" 
              data-position="top" 
              data-tooltip="<?php echo $i18n['LOGOUT']; ?>"
              >
              <i class="material-icons">exit_to_app</i>
            </a>
          </li>
        </ul>
        <ul class="right">
          <li><a class="modal-trigger" href="#modal1"><?php echo $i18n["Info"]; ?></a></li>
        </ul>        
        <form class="black right" method="GET">
          <div class="input-field">
            <input value="<?php echo htmlentities(@$_GET['q']); ?>" 
             placeholder="<?php echo count($data).' '.$TYPE; ?>" 
             id="search" type="search" name="q" required>
            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
            <i class="material-icons">close</i>
          </div>
        </form>
      </div>
    </nav>
  </div>
  <main>
    <div class="section no-pad-bot" id="index-banner">
      <div class="container">
