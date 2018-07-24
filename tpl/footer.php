        <div id="modal1" class="modal modal-fixed-footer " style="max-width:600px;">
          <div class="modal-content"><!-- ADD MODAL-CLASS "bottom-sheet" IF U LIKE -->
            <blockquote>
              <h4>Todo Tracker&trade;</h4>
              <p>
                <?php echo $i18n['INFORMATION']; ?>
              </p>
            </blockquote>
            <p>
              <img 
                style="max-width:100%;" 
                alt="Thanks to Jonathan Silva" 
                src="tpl/img/project-deadline-progress-bar-animation.gif"
              >
            </p>
            <p>
              <strong>Credits</strong><br>
              <a target="_blank" href="https://github.com/Mahi2/IssueTracker">
                Idea from SingleBugs (GPL3)</a><br> 
              <a target="_blank" href="http://materializecss.com/">
                Materialize Responsive Framework (MIT)</a><br>
              <a target="_blank" href="./tpl/css/progress.css">
                Slim Progress Bar with Pure CSS (WTFPL)</a><br> 
              <a target="_blank" href="http://jquery.com/">
                jQuery JavaScript Library (MIT)</a> &amp;
              <a target="_blank" href="http://tablesorter.com/docs/">
                Tablesorter (MIT)</a><br>
              <a target="_blank" href="http://material.io/icons/">
                Material Icons (AL2)</a><br>
              <a target="_blank" href="https://goo.gl/UV4mvb">
                GIF by Jonathan Silva</a><br>
              <a target="_blank" href="http://visualpharm.com/">
                Logo by Visualpharm (CC)</a><br>
            </p>
            <p>
              THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
            </p>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-black btn-flat">
              <i class="material-icons">close</i><!-- or &times; = X -->
            </a>
          </div>
        </div>
        <!--/MODAL-->
      </div>
    </div>
  </main>
  <footer class="page-footer black">  
    <div class="footer-copyright">
      <div class="container">
      &copy; 2018 
      <a class="grey-text text-lighten-1" href="http://about.me">mahid_hm</a>
      </div>
    </div>
  </footer>
  <script src="tpl/js/jquery-2.1.1.min.js"></script>
  <script src="tpl/js/materialize.min.js"></script>
  <script src="tpl/js/jquery.tablesorter.js"></script>
  <script>
    $(document).ready(function(){
      $('.modal').modal();
      $('select').formSelect();
      $('.tooltipped').tooltip();
      $("#table").tablesorter({headers:{5:{sorter:false}}});
      $('input#date, input#name, textarea#text').characterCounter();
      $('.datepicker').datepicker({format: '<?php echo $PICK; ?>'});
    });
    <?php if ( @$_GET['msg'] != '' ) { echo "M.toast({html: '".$_GET['msg']."'})";} ?>
  </script>
</body>
</html>
