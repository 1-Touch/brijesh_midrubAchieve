<h1>Test Planner</h1>
<section class="section planner-page" data-up="<?php echo (get_option('upload_limit')) ? get_option('upload_limit'):'6'; ?>" data-date-format="<?php if ( get_user_option('24_hour_format') ) { echo 24; } else { echo 12; } ?>">
    <div class="row">
        <div class="col-xl-3">
            <div class="col-xl-12">
                <div class="panel panel-primary" id="planner-posts-list">
                    <div class="panel-heading history-post-status" id="accordion">
                        <div class="checkbox-option-select">
                            <input id="planner-app-select-all-posts" name="planner-app-select-all-posts" type="checkbox">
                            <label for="planner-app-select-all-posts"></label>
                        </div>
                        <div class="dropdown show">
                            <a class="btn btn-secondary btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-magic-wand"></i> <?php echo $this->lang->line('actions'); ?>
                            </a>

                            <div class="dropdown-menu dropdown-menu-action" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" data-id="1" href="#"><i class="icon-clock"></i> <?php echo $this->lang->line('planify'); ?></a>
                                <a class="dropdown-item" data-id="3" href="#"><i class="icon-direction"></i> <?php echo $this->lang->line('add_posts_planification'); ?></a>
                                <a class="dropdown-item" data-id="2" href="#"><i class="icon-trash"></i> <?php echo $this->lang->line('delete'); ?></a>
                            </div>
                        </div>
                        <?php
                        if ( get_option('app_planner_enable_csv_import') ) {
                            ?>
                            <a href="#" class="pull-right" data-toggle="modal" data-target="#planner-csv-import"><i class="icon-cloud-upload"></i></a>
                            <?php
                        }
                        ?>
                        <a href="#" class="pull-right" data-toggle="modal" data-target="#planner-new-post"><i class="icon-note"></i></a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-8 input-group planner-posts-search">
                                <div class="input-group-prepend">
                                    <i class="icon-magnifier"></i>
                                </div>
                                <input type="text" class="form-control planner-search-for-posts" placeholder="<?php echo $this->lang->line('search_posts'); ?>">
                                <button type="button" class="planner-cancel-search-for-posts">
                                    <i class="icon-close"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <div class="dropdown show">
                                    <a class="btn btn-secondary btn-md dropdown-toggle" href="#" role="button" id="dropdownDisplayedPosts" data-limit="10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-sort-numeric-down"></i> 10
                                    </a>

                                    <div class="dropdown-menu dropdown-posts-limit" aria-labelledby="dropdownDisplayedPosts">
                                        <a class="dropdown-item" data-limit="10" href="#">10 <?php echo $this->lang->line('planner_posts'); ?></a>
                                        <a class="dropdown-item" data-limit="20" href="#">20 <?php echo $this->lang->line('planner_posts'); ?></a>
                                        <a class="dropdown-item" data-limit="50" href="#">50 <?php echo $this->lang->line('planner_posts'); ?></a>
                                        <a class="dropdown-item" data-limit="100" href="#">100 <?php echo $this->lang->line('planner_posts'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="history-posts">
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <nav>
                            <ul class="pagination" data-type="history-posts">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="col-xl-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="planner-bulk-schedule" tabindex="-1" role="dialog" aria-labelledby="planner-bulk-schedule" aria-hidden="true">
    <div class="modal-dialog file-upload-box modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active show" id="planner-bulk-schedule-planify-tab" data-toggle="tab" href="#nav-planner-bulk-schedule-planify" role="tab" aria-controls="nav-planner-bulk-schedule-planify" aria-selected="true">
                            <?php echo $this->lang->line('planify'); ?>
                        </a>
                        <a class="nav-item nav-link" id="nav-planner-bulk-schedule-planifications-tab" data-toggle="tab" href="#nav-planner-bulk-schedule-planifications" role="tab" aria-controls="nav-planner-bulk-schedule-planifications" aria-selected="true">
                            <?php echo $this->lang->line('details'); ?>
                        </a>   
                        <?php
                        if ( get_option('app_planner_enable_faq') ) {
                            ?>
                            <a class="nav-item nav-link" id="planner-bulk-schedule-faq-tab" data-toggle="tab" href="#nav-planner-bulk-schedule-faq" role="tab" aria-controls="nav-planner-bulk-schedule-faq" aria-selected="false">
                                <?php echo $this->lang->line('faq'); ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </nav>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="nav-planner-bulk-schedule-planify" role="tabpanel" aria-labelledby="nav-planner-bulk-schedule-planify">
                        <div class="row planner-bulk-schedule-accounts-manager">
                            <div class="col-xl-12">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active show" id="nav-accounts-manager-tab" data-toggle="tab" href="#nav-accounts-manager" role="tab" aria-controls="nav-accounts-manager" aria-selected="true">
                                           <?php echo $this->lang->line('accounts'); ?> 
                                        </a>
                                        <a class="nav-item nav-link" id="nav-groups-manager-tab" data-toggle="tab" href="#nav-groups-manager" role="tab" aria-controls="nav-groups-manager" aria-selected="false">
                                            <?php echo $this->lang->line('groups'); ?> 
                                        </a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade active show" id="nav-accounts-manager" role="tabpanel" aria-labelledby="nav-accounts-manager">
                                    </div>
                                    <div class="tab-pane fade" id="nav-groups-manager" role="tabpanel" aria-labelledby="nav-groups-manager">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 planner-bulk-schedule-posts-list">
                                <ul class="planner-bulk-schedule-history-posts">
                                </ul
                                <nav>
                                    <ul class="pagination" data-type="history-posts-planify">
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-xl-6 col-lg-6 clean post-destination">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-10 col-sm-10 col-9 input-group planner-bulk-schedule-accounts-search">
                                            <div class="input-group-prepend">
                                                <i class="icon-magnifier"></i>
                                            </div>
                                            <?php
                                            if ( get_user_option('settings_display_groups') ) {
                                                
                                                echo '<input type="text" class="form-control planner-bulk-schedule-search-for-groups" placeholder="' . $this->lang->line('search_for_groups') . '">'
                                                    . '<button type="button" class="planner-bulk-schedule-cancel-search-for-groups">'
                                                        . '<i class="icon-close"></i>'
                                                    . '</button>';                                                
                                                
                                            } else {
                                              
                                                echo '<input type="text" class="form-control planner-bulk-schedule-search-for-accounts" placeholder="' . $this->lang->line('search_for_accounts') . '">'
                                                    . '<button type="button" class="planner-bulk-schedule-cancel-search-for-accounts">'
                                                        . '<i class="icon-close"></i>'
                                                    . '</button>';
                                                
                                            }
                                            ?>
                                        </div>
                                        <div class="col-xl-2 col-sm-2 col-3">
                                            <button type="button" class="planner-bulk-schedule-manage-members"><i class="icon-user-follow"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                        if ( get_user_option('settings_display_groups') ) {

                                            echo '<div class="col-xl-12 planner-bulk-schedule-groups-list">'
                                                    . '<ul>';

                                            if ( $groups_list ) {

                                                foreach ( $groups_list as $group ) {
                                                    ?>
                                                    <li>
                                                        <a href="#" data-id="<?php echo $group->list_id; ?>">
                                                            <?php echo '<i class="icon-folder-alt"></i>'; ?>
                                                            <?php echo $group->name; ?>
                                                            <i class="icon-check"></i>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }

                                            } else {

                                                echo '<li class="no-groups-found">' . $this->lang->line('no_groups_found') . '</li>';

                                            }

                                                echo '</ul>'
                                                . '</div>';

                                        } else {

                                            echo '<div class="col-xl-12 planner-bulk-schedule-accounts-list">'
                                                    . '<ul>';

                                            if ( $accounts_list ) {

                                                foreach ( $accounts_list as $account ) {
                                                    ?>
                                                    <li>
                                                        <a href="#" data-id="<?php echo $account['network_id']; ?>" data-net="<?php echo $account['net_id']; ?>" data-network="<?php echo $account['network_name']; ?>" data-category="<?php echo in_array('categories', $account['network_info']['types']) ? 'true' : 'value'; ?>">
                                                            <?php echo str_replace(' class', ' style="color: ' . $account['network_info']['color'] . '" class', $account['network_info']['icon'] ); ?>
                                                            <?php echo $account['user_name']; ?>
                                                            <i class="icon-check"></i>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }

                                            } else {

                                                echo '<li class="no-accounts-found">' . $this->lang->line('no_accounts_found') . '</li>';

                                            }

                                                echo '</ul>'
                                                . '</div>';

                                        }
                                        ?>
                                    </div>
                                    <div class="row planner-bulk-schedule-colapse-selected-accounts">
                                        <div class="col-6">
                                            <p class="planner-bulk-schedule-colapse-selected-accounts-count">0 <?php echo $this->lang->line('selected_accounts'); ?></p>
                                        </div>
                                        <div class="col-6">
                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <i class="icon-plus"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body planner-bulk-schedule-colapse-selected-accounts-list">
                                                    <ul>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_open('user/app/planner', ['class' => 'planify-save-panifications', 'data-csrf' => $this->security->get_csrf_token_name()]) ?>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 planner-bulk-schedule-post-actions">
                                    <div class="row planner-bulk-schedule-planification-title">
                                        <div class="col-xl-12 col-sm-12 col-12">
                                            <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('enter_planification_title'); ?>" required>
                                        </div>
                                    </div>
                                    <?php
                                    if ( get_user_option('settings_planner_media_categories') ) {
                                    ?>
                                    <div class="row planner-bulk-schedule-planifications">
                                        <div class="col-xl-6 col-sm-6 col-6 input-group">
                                            <i class="icon-tag"></i>
                                            <?php echo $this->lang->line('multimedia_category'); ?>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 col-6 text-right">
                                            <div class="dropdown show">
                                                <a class="btn btn-secondary btn-md dropdown-toggle dropdown-selected-category" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-grip-horizontal"></i>
                                                    <?php echo $this->lang->line('categories'); ?>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-action dropdown-categories-list" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" data-id="0" href="#">
                                                        <i class="fas fa-grip-horizontal"></i>
                                                        <?php echo $this->lang->line('categories'); ?>
                                                    </a>                                                 
                                                    <?php
                                                    if ( $multimedia_categories ) {
                                                        
                                                        foreach ( $multimedia_categories as $category ) {
                                                            
                                                            echo '<a class="dropdown-item" data-id="' . $category->list_id . '" href="#">'
                                                                    . '<i class="far fa-arrow-alt-circle-right"></i>'
                                                                    . $category->name
                                                                . '</a>';
                                                            
                                                        }
                                                        
                                                    } else {
                                                        
                                                        echo $this->lang->line('no_categories_found');
                                                        
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="row planner-bulk-schedule-planifications">
                                        <div class="col-xl-6 col-sm-6 col-6 input-group">
                                            <i class="icon-directions"></i>
                                            <?php echo $this->lang->line('planification_rules'); ?>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 col-6">
                                            <button type="button" class="planner-bulk-schedule-new-planification">
                                                <i class="icon-direction"></i> <?php echo $this->lang->line('new_planification_rule'); ?>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row planner-bulk-schedule-planifications-list">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-right">
                                <div>
                                    <button type="submit" class="btn btn-success"><i class="far fa-save"></i><?php echo $this->lang->line('save'); ?></button>
                                </div>
                            </div>
                        <?php echo form_close(); ?> 
                    </div>
                    <div class="tab-pane fade" id="nav-planner-bulk-schedule-planifications" role="tabpanel" aria-labelledby="nav-planner-bulk-schedule-planifications">
                    </div>
                    <?php
                    if ( get_option('app_planner_enable_faq') ) {
                        ?>
                        <div class="tab-pane fade" id="nav-planner-bulk-schedule-faq" role="tabpanel" aria-labelledby="nav-planner-bulk-schedule-faq">
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <?php echo $this->lang->line('categories'); ?>
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active" id="about-nav" data-toggle="tab" href="#about-tab" role="tab" aria-controls="about-tab" aria-selected="true"><?php echo $this->lang->line('how_to_planify'); ?> <i class="fas fa-angle-right"></i></a>
                                                    <a class="nav-item nav-link" id="planifications-nav" data-toggle="tab" href="#planifications-tab" role="tab" aria-controls="planifications-tab" aria-selected="false"><?php echo $this->lang->line('planifications'); ?>  <i class="fas fa-angle-right"></i></a>
                                                    <a class="nav-item nav-link" id="posts-nav" data-toggle="tab" href="#posts-tab" role="tab" aria-controls="posts-tab" aria-selected="false"><?php echo ucfirst($this->lang->line('planner_posts')); ?> <i class="fas fa-angle-right"></i></a>
                                                    <a class="nav-item nav-link" id="rules-nav" data-toggle="tab" href="#rules-tab" role="tab" aria-controls="rules-tab" aria-selected="false"><?php echo ucfirst($this->lang->line('rules')); ?> <i class="fas fa-angle-right"></i></a>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>                
                                <div class="col-xl-9">
                                    <div class="tab-content" id="nav-tabContent">
                                        <?php echo $this->lang->line('faq_tabs'); ?>
                                    </div>                   
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="planner-new-post" tabindex="-1" role="dialog" aria-labelledby="planner-new-post" aria-hidden="true">
    <div class="modal-dialog file-upload-box modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <?php echo form_open('user/app/planner', ['class' => 'planner-new-post-form', 'data-csrf' => $this->security->get_csrf_token_name()]) ?>
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $this->lang->line('new_post'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="planner-new-post-form-input">
                                <input type="text" class="planner-new-post-post-title" placeholder="<?php echo $this->lang->line('enter_post_title'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="planner-new-post-form-input">
                                <input type="text" class="planner-new-post-post-url" placeholder="<?php echo $this->lang->line('enter_post_url'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="planner-new-post-form-input">
                                <textarea placeholder="<?php echo $this->lang->line('enter_post_content'); ?>" class="planner-new-post-post-body"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="planner-new-post-form-input">
                                <div class="post-preview-medias">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="planner-new-post-form-input clean">
                                <div class="planner-bulk-schedule-history-posts-edit-media-head">
                                    <h3><?php echo $this->lang->line('media_files'); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>                   
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="planner-bulk-schedule-history-posts-edit-media-area">
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="modal-footer">
                    <div>
                        <button class="btn planner-new-post-save" type="submit">
                            <i class="far fa-save"></i>
                            <?php echo $this->lang->line('save'); ?>
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="planner-csv-import" tabindex="-1" role="dialog" aria-labelledby="planner-csv-import" aria-hidden="true">
    <div class="modal-dialog file-upload-box modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?php echo $this->lang->line('import_csv'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <button type="button" class="btn btn-outline-secondary planner-import-posts-from-csv">
                            <?php echo $this->lang->line('import_csv_btn'); ?>
                        </button>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <a href="#" class="download-csv-example">
                            <?php echo $this->lang->line('download_csv_example'); ?>
                        </a>
                    </div>
                </div>                        
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="planner-add-posts-to-plannification" tabindex="-1" role="dialog" aria-labelledby="planner-add-posts-to-plannification" aria-hidden="true">
    <div class="modal-dialog file-upload-box modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <?php echo form_open('user/app/planner', ['class' => 'add-posts-to-planification', 'data-csrf' => $this->security->get_csrf_token_name()]) ?>
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $this->lang->line('add_posts_to_planification'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="planner-new-post-form-input">
                                <select class="planner-select-planification">
                                    
                                </select>
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="modal-footer">
                    <div>
                        <button class="btn planner-new-post-save" type="submit">
                            <i class="far fa-save"></i>
                            <?php echo $this->lang->line('save'); ?>
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>

<!-- Planner modal !-->
<div class="midrub-planner">
    <div class="row">
        <div class="col-xl-12">
            <table class="midrub-calendar iso">
                <thead>
                    <tr>
                        <th class="text-center"><a href="#" class="go-back"><i class="icon-arrow-left"></i></a></th>
                        <th colspan="5" class="text-center year-month"></th>
                        <th class="text-center"><a href="#" class="go-next"><i class="icon-arrow-right"></i></a></th>
                    </tr>
                </thead>
                <tbody class="calendar-dates">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Upload image form !-->
<?php
$attributes = array('class' => 'upim d-none', 'id' => 'upim', 'method' => 'post', 'data-csrf' => $this->security->get_csrf_token_name() );
echo form_open_multipart('user/app/planner', $attributes);
?>
<input type="hidden" name="type" id="type" value="video">
<input type="file" name="file[]" id="file" accept=".gif,.jpg,.jpeg,.png,.mp4,.avi">
<?php echo form_close(); ?>

<!-- Upload csv form !-->
<?php
$attributes = array('class' => 'upcsv d-none', 'id' => 'upcsv', 'method' => 'post', 'data-csrf' => $this->security->get_csrf_token_name());
echo form_open_multipart('user/app/planner', $attributes);
?>
<input type="file" name="csvfile[]" id="csvfile" accept=".csv">
<?php echo form_close(); ?>

<!-- Translations !-->
<script language="javascript">
    var words = {
        please_select_a_post: '<?php echo $this->lang->line('please_select_at_least_post'); ?>',
        file_too_large: '<?php echo $this->lang->line('file_too_large'); ?>',
        mon: '<?php echo $this->lang->line('mon'); ?>',
        tue: '<?php echo $this->lang->line('tue'); ?>',
        wed: '<?php echo $this->lang->line('wed'); ?>',
        thu: '<?php echo $this->lang->line('thu'); ?>',
        fri: '<?php echo $this->lang->line('fri'); ?>',
        sat: '<?php echo $this->lang->line('sat'); ?>',
        sun: '<?php echo $this->lang->line('sun'); ?>',
        ordered: '<?php echo $this->lang->line('ordered'); ?>',
        random: '<?php echo $this->lang->line('random'); ?>',
        posts_daily: '<?php echo $this->lang->line('posts_daily'); ?>',
        exact_interval: '<?php echo $this->lang->line('exact_interval'); ?>',
        random_interval: '<?php echo $this->lang->line('random_interval'); ?>',
        delet: '<?php echo $this->lang->line('delete'); ?>',
        save: '<?php echo $this->lang->line('save'); ?>',
        cancel: '<?php echo $this->lang->line('cancel'); ?>',
        post_title: '<?php echo $this->lang->line('post_title'); ?>',
        post_url: '<?php echo $this->lang->line('post_url'); ?>',
        post_body: '<?php echo $this->lang->line('post_body'); ?>',
        post_media_files: '<?php echo $this->lang->line('post_media_files'); ?>',
        selected_accounts: '<?php echo $this->lang->line('selected_accounts'); ?>',
        selected_groups: '<?php echo $this->lang->line('selected_groups'); ?>',
        at_least_planification_rule: '<?php echo $this->lang->line('at_least_planification_rule'); ?>',
        no_days_selected: '<?php echo $this->lang->line('no_days_selected'); ?>',
        range_time_at_least_1_day: '<?php echo $this->lang->line('range_time_at_least_1_day'); ?>',
        please_select_at_least_one_account: '<?php echo $this->lang->line('please_select_at_least_one_account'); ?>',
        no_post_to_planify: '<?php echo $this->lang->line('no_post_to_planify'); ?>',
        no_posts_found: '<?php echo $this->lang->line('no_posts_found'); ?>',
        delete_planification: '<?php echo $this->lang->line('delete_planification'); ?>',
        are_you_sure: '<?php echo $this->lang->line('mu68'); ?>',
        yes: '<?php echo $this->lang->line('yes'); ?>',
        no: '<?php echo $this->lang->line('no'); ?>',
        please_select_group: '<?php echo $this->lang->line('please_select_group'); ?>',
        categories: '<?php echo $this->lang->line('categories'); ?>'
    };
</script>
