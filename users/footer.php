  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>FlipAvenue</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">Flip</a>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



<!-- working on updating user hourly rate code... -->
 <script>
    function addCommas(input) {
        // Remove existing commas and non-numeric characters
        let value = input.value.replace(/,/g, '').replace(/\D/g, '');
        
        // Add commas back to the number
        let formattedValue = new Intl.NumberFormat().format(value);
        
        // Update the input value with commas
        input.value = formattedValue;
    }
</script>

</body>
</html>