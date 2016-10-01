function taskOptionInit(){
    inputOptionDelete();
    inputOptionSubmit();
    taskOptionFinish();
    deleteTaskOption();
}

//点击增加任务子项目
$("button[name=add-task-option-btn]").on("click", function () {
    $("#task-option-body").append($("#taskOptionInput").html());
    taskOptionInit();
});

//点击删除输入框
function inputOptionDelete(){
    $("button[name=table-btn-input-option-delete]").unbind().on("click", function () {
        $(this).parent().parent().remove();
    });
}

//点击提交新任务子项目
function inputOptionSubmit(){
    $("button[name=table-btn-input-option-finish]").unbind().on("click", function () {
        var th = $(this);
        var title = $(this).parent().parent().find("input[name=title]").val();
        var taskId = taskOptionModel.data('taskid');
        if (!title || !taskId) {
            alert('添加内容不能为空');
            return false;
        }
        var data = {
            title: title,
            task_id: taskId
        };
        http.post(addTaskOptionsUrl, data)
            .success(function (data, status) {
                data = parseJson(data)[0];
                if(data.code==1){
                    var html = juicer($("#taskOptionTr").html(),{
                        id:data.data.id,
                        title:data.data.title
                    });
                    $("#task-option-body").append(html);
                    //删除输入框
                    th.parent().parent().remove();
                    init();
                }else{
                    alert(data.message);
                }
                taskOptionInit();
            });
    });
}//完成任务
function taskOptionFinish(){
    $("button[name=table-btn-option-finish]").unbind().on("click",function(){
        var taskOptionId = $(this).data('taskoptionid');
        var data = {
            task_option_id:taskOptionId,
            status:2
        };
        var th = $(this);
        http.post(changeTaskOptionsStatusUrl,data)
            .success(function(data,status){
                data = parseJson(data)[0];
                if(data.code==1){
                    th.parent().parent().remove();
                }else{
                    alert(data.message);
                }
            });
    })
}

//删除字任务
function deleteTaskOption(){
    $("button[name=table-btn-option-delete]").on('click',function(){
        if(confirm('确定要删除任务吗？')){
            var taskOptionId = $(this).data('taskoptionid');
            var data = {
                task_option_id:taskOptionId,
            };
            var th = $(this);
            http.post(deleteTaskOptionUrl,data)
                .success(function(data,status){
                    data = parseJson(data)[0];
                    if(data.code==1){
                        th.parent().parent().remove();
                    }else{
                        alert(data.message);
                    }
                });
        }
    })
}