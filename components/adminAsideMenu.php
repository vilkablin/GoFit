<?php
global $user;
?>
             <div class="admin-aside d-flex-columns">
                 <div class="admin-profile d-flex-columns">
                     <div class="admin-info d-flex-rows">
                         <div class="avatar">
                             <img src="<?php echo is_null($user['avatar']) ? 'media/icons/avatar.svg' : $user['avatar'];  ?>" alt="Аватар">
                         </div>
                         <div class="info-text d-flex-columns">
                             <p><?=$user['name']?> <br>
                             <?=$user['surname']?></p>
                             <p class="role">Администратор</p>
                         </div>

                     </div>

                     <p class="mail"><?=$user['email']?></p>
                 </div>
    

                 <a href="?page=orders&adminpanel">Заказы</a>
                 <a href="?page=products&adminpanel">Товары</a>
                 <a href="?page=users&adminpanel">Пользователи</a>
                 <a href="#">Промокоды</a>
                 <a href="actions/user/exit.php" id="exitBtn" class="exit">
                     <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M27.3333 6.83339H32.4583C33.3645 6.83339 34.2335 7.19336 34.8743 7.83411C35.515 8.47486 35.875 9.3439 35.875 10.2501V11.9584M27.3333 34.1667H32.4583C33.3645 34.1667 34.2335 33.8068 34.8743 33.166C35.515 32.5253 35.875 31.6562 35.875 30.7501V29.0417M27.335 20.5001H35.8767M35.8767 20.5001L32.46 17.0834M35.8767 20.5001L32.46 23.9167M7.55938 33.1896L17.8094 36.2646C18.3196 36.4177 18.8586 36.4494 19.3833 36.3572C19.908 36.2649 20.4039 36.0513 20.8313 35.7332C21.2587 35.4152 21.6058 35.0017 21.8449 34.5256C22.084 34.0495 22.2085 33.5241 22.2083 32.9914V8.00872C22.2085 7.47598 22.084 6.9506 21.8449 6.47453C21.6058 5.99845 21.2587 5.58489 20.8313 5.26687C20.4039 4.94885 19.908 4.73518 19.3833 4.64292C18.8586 4.55067 18.3196 4.5824 17.8094 4.73556L7.55938 7.81056C6.85558 8.02182 6.23864 8.45435 5.80011 9.04398C5.36159 9.63361 5.12484 10.3489 5.125 11.0837V29.9164C5.12484 30.6512 5.36159 31.3665 5.80011 31.9561C6.23864 32.5458 6.85558 32.9783 7.55938 33.1896Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                 </a>
             </div>
   