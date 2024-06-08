<div class="col-12 col-md-12 mx-auto text-center">
    <div class="user-more">

    <img alt="User Pic"  src="{{ @fopen(\Url('storage/app/images/users/').'/'.$item->profile_pic, 'r') ? \Url('storage/app/images/users/').'/'.$item->profile_pic : asset('public/nobody_user.jpg') }}"
         
        id="profile-pic" class="rounded-circle profile_users_img" width="150" height="150">
        <!-- <div class="overlay">
                <div class="text"><a href="#" class="profile_users_img">Edit</a></div>
            </div> -->

    </div>
</div>