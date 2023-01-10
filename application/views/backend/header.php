<div class="row">
    <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
        <h2 style="font-weight:200; margin:0px;">system</h2>
    </div>

    <!-- Raw Links -->
    <div class="col-md-12 col-sm-12 clearfix ">

        <ul class="list-inline links-list pull-left">
            <!-- add logine type name in the header 		
            <li class="dropdown language-selector">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                    <i class="entypo-user"></i> <?php echo $this->session->userdata('login_type'); ?>
                </a>
            </li>
            -->	
            <!-- Message Notifications -->
            <?php if($this->session->userdata('login_type') == 'doctor' || $this->session->userdata('login_type') == 'patient') { ?>
            <li class="notifications dropdown">
                <?php
                $total_unread_message_number = 0;
                $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

                $this->db->where('sender', $current_user);
                $this->db->or_where('reciever', $current_user);
                $message_threads = $this->db->get('message_thread')->result_array();
                foreach ($message_threads as $row) {
                    $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                    $total_unread_message_number += $unread_message_number;
                }
                ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="entypo-mail"></i>
                    <?php if ($total_unread_message_number > 0): ?>
                        <span class="badge badge-info"><?php echo $total_unread_message_number; ?></span>
                    <?php endif; ?>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <ul class="dropdown-menu-list scroller">


                            <?php
                            $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
                            $this->db->where('sender', $current_user);
                            $this->db->or_where('reciever', $current_user);
                            $message_threads = $this->db->get('message_thread')->result_array();
                            foreach ($message_threads as $row):

                                // defining the user to show
                                if ($row['sender'] == $current_user)
                                    $user_to_show = explode('-', $row['reciever']);
                                if ($row['reciever'] == $current_user)
                                    $user_to_show = explode('-', $row['sender']);
                                $user_to_show_type = $user_to_show[0];
                                $user_to_show_id = $user_to_show[1];
                                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                                if ($unread_message_number == 0)
                                    continue;

                                // the last sent message from the opponent user
                                $this->db->order_by('timestamp', 'desc');
                                $last_message_row = $this->db->get_where('message', array('message_thread_code' => $row['message_thread_code']))->row();
                                $last_unread_message = $last_message_row->message;
                                $last_message_timestamp = $last_message_row->timestamp;
                                ?>
                                <li class="active">
                                    <a href="<?php echo site_url($this->session->userdata('login_type') . '/message/message_read/' . $row['message_thread_code']); ?>">
                                        <span class="image pull-right">
                                            <img src="<?php echo $this->crud_model->get_image_url($user_to_show_type, $user_to_show_id); ?>" height="48" class="img-circle" />
                                        </span>

                                        <span class="line">
                                            <strong>
                                                <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>
                                            </strong>
                                            - <?php echo date("d M, Y", $last_message_timestamp); ?>
                                        </span>

                                        <span class="line desc small">
                                            <!-- preview of the last unread message substring -->
                                            <?php
                                            echo substr($last_unread_message, 0, 50);
                                            ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li class="external">
                        <a href="<?php echo site_url($this->session->userdata('login_type') . '/message'); ?>">
                            <?php echo get_phrase('view_all_messages'); ?>
                        </a>
                    </li>				
                </ul>
            </li>
            <?php } ?>
        </ul>


        <ul class="list-inline links-list pull-right">

       
            <li class="sep"></li>
            <li>
                <a href="<?php echo site_url('login/logout'); ?>">
                    تسجيل خروج &nbsp;<i class="fa fa-sign-out"></i>
                </a>
            </li>
        </ul>
    </div>

</div>

<hr style="margin-top:0px;" />