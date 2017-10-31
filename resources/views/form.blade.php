<form action="les16" method="post" enctype='multipart/form-data'>
             <input type='hidden' name='_token' value="{{csrf_token()}}" />
            <div class="">
                <label form=""> 姓名 </label>
                <input type='text' name='name'>
            </div>
            <div class="">
                <label form=""> 姓名 </label>
                <input type='text' name='age'>
            </div>
            <div class="">
                <label form=""> file </label>
                <input type='file' name='profile' mutiple/>
            </div>
            <button type='submit'> 提交 </button>
</form>
