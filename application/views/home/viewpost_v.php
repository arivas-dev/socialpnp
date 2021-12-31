<main>
    <div class="main-section">
        <div class="container">
            <div class="main-section-data">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="main-ws-sec">
                            <div class="posts-section">
                                <div class="post-bar no-margin">
                                    <div class="post_topbar">
                                        <div class="usy-dt">
                                        <?php 
                                            $image_user =  "https://via.placeholder.com/35x35";
                                            $type_logueo = tipo_logueo($this->session->userdata('id')); 
                                            if ($dataUsuario->foto_perfil != NULL) {
                                                $image_user = base_url($dataUsuario->foto_perfil);
                                                if ($type_logueo->tipo_registro == 2) {
                                                    $image_user = $dataUsuario->foto_perfil;
                                                }
                                            }
                                        ?>
                                            <img src="<?php echo $image_user ?>" alt="" style="width: 50px;height: 50px;">
                                            <div class="usy-name">
                                                <h3>
                                                <?php
                                                if ($this->session->userdata('rol') == "ROLE_FREELANCER") {
                                                    echo $dataUsuario->nombres . " " . $dataUsuario->apellidos;
                                                }else{
                                                    echo $dataUsuario->nombre;
                                                }
                                                ?>
                                                </h3>
                                                <span><img src="<?php echo base_url('resources/images/clock.png') ?>" alt=""><?php echo $dataPost->hora_post ?></span>
                                            </div>
                                        </div>
                                        <div class="ed-opts">
                                            <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                        </div>
                                    </div>
                                    <?php if ($dataPost->nombre != NULL): ?>
                                    <div>
                                        <img src="<?php echo base_url($dataPost->nombre) ?>" style="width: 300px">
                                    </div>
                                    <?php endif ?>
                                    <div class="job_descp"> 
                                        <h3>Título: <?php echo $dataPost->titulo; ?></h3>
                                        <ul class="job-dt">
                                            <li><span>Precio $ <?php echo $dataPost->precio; ?></span></li>
                                        </ul>
                                        <label>Horario de atención:</label>
                                        <p><?php echo $dataPost->opcion_tiempo; ?></p>
                                        <label>Descripción:</label>
                                        <p><?php echo $dataPost->descripcion; ?><!-- <a href="#" title="">ver más</a> --></p>
                                        <ul class="skill-tags">
                                            <?php 

                                                $skils = explode(",", $dataPost->post_tags);
                                                $cant = sizeof($skils);
                                                for ($i=0; $i <= ($cant - 1) ; $i++) { 
                                                    echo '<li><a title="'.$skils[$i].'" style="cursor: pointer;">'.$skils[$i].'</a></li>';
                                                }
                                                ?>
                                        </ul>
                                    </div>
                                    <div class="job-status-bar">
                                        <ul class="like-com">
                                            <li>
                                                <a title="Clic para ver" class="com see-comment" style="cursor: pointer;" data-id="<?php echo $dataPost->id; ?>">
                                                    <img src="<?php echo base_url('resources/images/com.png') ?>">
                                                    <?php $coment_cont = contar_comentarios($dataPost->id);// por medio de helper ?>
                                                    Comentarios (<label id="com-cant-<?php echo $dataPost->id; ?>"><?php echo $coment_cont->cant; ?></label>)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--post-bar end-->
                                <div class="comment-section" style="margin-bottom: 15px;">
                                    <div class="post-comment">
                                        <div class="cm_img">
                                            <img src="<?php echo $image_user ?>" style="width: 100%;">
                                        </div>
                                        <div class="comment_box">
                                            <form class="frm-comment" autocomplete="off" data-id="<?php echo $dataPost->id; ?>">
                                                <input type="hidden" value="<?php echo $dataPost->id; ?>" name="postId">
                                                <input type="text" placeholder="Comentario" id="text-com<?php echo $dataPost->id; ?>" name="comment">
                                                <button type="submit" title="Comentar" id="btn-comment-<?php echo $dataPost->id; ?>">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                    <div class="comment-sec" id="comment-sec_<?php echo $dataPost->id; ?>">
                        <br>
                        <ul id="push-com-<?php echo $dataPost->id; ?>">
                            <?php if ($coment_cont->cant > 0): ?>

                                <?php 
                                    //extraer comentarios por medio de helper
                                    $comment_list = get_comentarios($dataPost->id);
                                    foreach ($comment_list as $val) {
                                        $rol_user_com = verificar_rol_socio($val->id_usuario);//desde helper
                                        if ($rol_user_com->rol == "ROLE_FREELANCER") {
                                            $info_user_com = info_solicitud_f($val->id_usuario);
                                            $name_user = $info_user_com->nombres." ".$info_user_com->apellidos;
                                        }else{
                                            $info_user_com = info_solicitud_e($val->id_usuario);
                                            $name_user = $info_user_com->nombre;
                                        }
                                        //validar si tiene foto de perfil
                                        $user_foto = "https://via.placeholder.com/35x35";
                                        $type_logueo_com = tipo_logueo($val->id_usuario);
                                        if ($info_user_com->foto_perfil != NULL) {
                                            $user_foto = base_url($info_user_com->foto_perfil);
                                            if ($type_logueo_com->tipo_registro == 2) {
                                                $user_foto = $info_user_com->foto_perfil;
                                            }
                                        }
                                        //validar para colocar estilo a comentario
                                        $estilo_com = "";
                                        if ($idcomment == $val->id) {
                                            $estilo_com = "style='border: 1px solid red;padding: 5px;margin-bottom: 5px;'";
                                        }
                                ?>
                                <li <?php echo $estilo_com ?>>
                                    <div class="comment-list">
                                        <div class="bg-img">
                                            <img src="<?php echo $user_foto; ?>" style="width: 40px;height: 40px">
                                        </div>
                                        <div class="comment">
                                            <h3><?php echo $name_user; ?></h3>
                                            <span><img src="<?php echo base_url('resources/images/clock.png') ?>"> <?php echo $val->hora_comentario ?></span>
                                            <p><?php echo $val->comentario ?></p>
                                            <?php if ($this->session->userdata('id') == $val->id_usuario): ?>
                                                <a style="cursor: pointer;" class="delete-com" com-id="<?php echo $val->id; ?>"><i class="fa fa-trash"></i>Eliminar</a>
                                            <?php endif ?>                                          
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            <?php else: ?>
                                <li id="no-comment-<?php echo $dataPost->id; ?>"><h3><b>No hay comentarios.</b></h3></li>
                            <?php endif ?>
                            
                        </ul>
                    </div>
                    
                </div><!--comment-section end-->
                            </div>
                            <!--posts-section end-->                       
                        </div>                        
                    </div>
                    <!--main-ws-sec end-->
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class="right-sidebar">
                            <div class="widget widget-jobs" style="text-align: center;">
                                <div class="sd-title">
                                    <h3>Publicidad</h3>
                                    <i class="la la-ellipsis-v"></i>
                                </div>
                                <div class="jobs-list" style="height: 200px;">
                                    <h4><b>"Este anuncio ayuda a financiar la misión de Socialpnp".</b></h4>
                                </div>
                                <div class="jobs-list" style="height: 200px;">
                                    <h4><b>"Únete a la red de emprendedores más grande del mundo".</b></h4>
                                </div>
                            </div>
                            <!--widget-jobs end-->
                        </div>
                        <!--right-sidebar end-->
                    </div>
                </div>
            </div><!-- main-section-data end-->
        </div>
    </div>
</main>