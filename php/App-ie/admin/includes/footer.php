<footer class="text-center col-md-12" id="footer">Copyright &copy; 2018 All rights reserved by Vlad </footer>
<script>
    function upadateSizes() {

        var sizeString = '';
        for(var i=1;i<=12;i++) {
            if(jQuery('#size'+i).val() !== '' && jQuery('#qty'+i).val() !== '' ) {
                sizeString += jQuery('#size'+i).val() + ':' + jQuery('#qty' + i).val() + ',';
            }
        }
        jQuery('#sizes').val(sizeString);
    }
    function get_child_options(selected) {
        if(typeof selected === 'undefined') {
            var selected = '';
        }
        var parentID = jQuery('#parent').val();
        jQuery.ajax ({
            url: '/ie/admin/parsers/child_categories.php',
            type : 'POST',
            data: { parentID : parentID,
                    selected : selected
                    },
            success: function(data) {
                jQuery('#child').html(data);
            },
            error: function() {alert("A aparut o eroare")}       
        })
    }
    jQuery('select[name="parent"]').change(function() {
        get_child_options();
    });
</script>
</body>
</html>