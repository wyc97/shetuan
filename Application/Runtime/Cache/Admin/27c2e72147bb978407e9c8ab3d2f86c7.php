<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>收支修改</title>
    <script src="/shetuan/Public/admin/js/jquery.min.js"></script>
</head>
<body>
    <h1>收支修改</h1>
    <table border="2px solid">
        收支类型
        <input type="radio" name="expensemethod" value="1"> 收入
        <input type="radio" name="expensemethod" value="2"> 支出
        <hr>
        金额<input type="text" id="expensecharge" value="<?php echo ($res['expensecharge']); ?>">
        <hr>
        时间<input type="text" id="expensetime"  value="<?php echo ($res['expensetime']); ?>">
        <hr>
        笔记<input type="text" id="expensenote"  value="<?php echo ($res['expensenote']); ?>">
    </table>
    <button id="subbtn" type="button" data-id="<?php echo ($res['expenseid']); ?>">确认提交</button>
</body>

<script>
    $('#subbtn').on('click',function () {
        var btn = $(this);
        var expenseid = btn.data('id');
        var expensemethod = $("input[type='radio']:checked").val();
        var expensecharge = $('#expensecharge').val();
        var expensenote = $('#expensenote').val();
        var expensetime = $('#expensetime').val();
        var param = {
            expenseid:expenseid,
            expensemethod:expensemethod,
            expensecharge:expensecharge,
            expensenote:expensenote,
            expensetime:expensetime
        };
        console.log(param);

        if(!expensemethod || !expensecharge || !expensenote || !expensetime){
            alert('每一项都必须填写');
            return;
        }else{
            var url = "<?php echo U('Expense/expensemodify');?>";
            $.ajax({
                url: url,
                data: param,
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    alert(data.info);
                    if (data.status == 1) {
                        window.location.href= "<?php echo U('Expense/departexpense');?>"
                    }
                },
                error: function () {
                    alert('操作失败');
                }
            })
        }

    })
</script>
</html>