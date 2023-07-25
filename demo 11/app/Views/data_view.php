<!DOCTYPE html>
<html>
<head>
    <title>Continuous Data Loading</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="data-container">
    <?php foreach($data as $row): ?>
    <div class="data-row">
        <div class="data-id"><?php echo $row['id']; ?></div>
        <div class="data-name"><?php echo $row['name']; ?></div>
    </div>
    <?php endforeach; ?>
</div>

<script>
var page = 1;

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
        page++;
        $.ajax({
            url: '/data/load_more_data',
            type: 'GET',
            data: {page: page},
            success: function(response) {
                var dataContainer = $('#data-container');
                $.each(response, function(index, row) {
                    var newRow = $('<div class="data-row"><div class="data-id">' + row.id + '</div><div class="data-name">' +
                        row.name + '</div></div>');
                    dataContainer.append(newRow);
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
});
</script>

</body>
</html>
