<?php 
  
App::import('Component', 'ConnectComponent');
$this->Connect = new ConnectComponent;
?>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
				<h1 style="display: inline-block;"><?= $Lang->get('SUPPORT') ?></h1>
				<?php if($this->Connect->connect() AND $Permissions->can('POST_TICKET')) { ?>
                	<a href="#" style="margin-top:-15px;"  data-toggle="modal" data-target="#post_ticket" class="btn btn-success hidden-md hidden-lg"><icon class="fa fa-pencil-square-o"></icon> <?= $Lang->get('POST_A_TICKET') ?></a>
                <?php } ?>
            </div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-9" id="content-tickets">
				<?php if(!empty($tickets)) { ?>
					<?php foreach ($tickets as $key => $value) { ?>
						<?php if($Permissions->can('VIEW_TICKETS') AND $value['Ticket']['private'] == 0 OR $this->Connect->connect() AND $this->Connect->if_admin() OR $this->Connect->connect() AND $this->Connect->get_pseudo() == $value['Ticket']['author'] OR $Permissions->can('VIEW_ALL_TICKETS')) { ?>
							<!-- Un ticket -->
							<div class="col-md-12" id="ticket-<?= $value['Ticket']['id'] ?>">
								<div class="panel panel-default">
								  <div class="panel-body">
								  	<h3 class="support"><?= $value['Ticket']['title'] ?> <?php if($value['Ticket']['state'] == 1) { echo '<icon style="color: green;" class="fa fa-check" title="'.$Lang->get('RESOLVED').'"></icon>'; } else { echo '<div style="display:inline-block;" id="ticket-state-'.$value['Ticket']['id'].'"><icon class="fa fa-times" style="color:red;" title="'.$Lang->get('UNRESOLVED').'"></icon></div>'; } ?></h3>
								    <img class="support" src="<?= $this->Html->url(array('controller' => 'API', 'action' => 'get_head_skin/')) ?>/<?= $value['Ticket']['author'] ?>/50" title="<?= $value['Ticket']['author'] ?>">
								    <div class="pull-right support">
								    	<?php if($this->Connect->connect() AND $this->Connect->if_admin() OR $this->Connect->connect() AND $this->Connect->get_pseudo() == $value['Ticket']['author'] AND $Permissions->can('DELETE_HIS_TICKET') OR $Permissions->can('DELETE_ALL_TICKETS')) { ?>
									    <p><a id="<?= $value['Ticket']['id'] ?>" title="<?= $Lang->get('DELETE') ?>" class="ticket-delete btn btn-danger btn-sm"><icon class="fa fa-times"></icon></a></p>
									    <?php } ?>
									    <?php if($value['Ticket']['state'] == 0) { ?>
										    <?php if($this->Connect->connect() AND $this->Connect->if_admin() OR $this->Connect->connect() AND $this->Connect->get_pseudo() == $value['Ticket']['author'] AND $Permissions->can('RESOLVE_HIS_TICKET') OR $Permissions->can('RESOLVE_ALL_TICKETS')) { ?>
										    <p class="div-ticket-resolved-<?= $value['Ticket']['id'] ?>"><a id="<?= $value['Ticket']['id'] ?>" title="<?= $Lang->get('RESOLVED') ?>" class="ticket-resolved btn btn-success btn-sm"><icon style="font-size: 10px;" class="fa fa-check"></icon></a></p>
										    <?php } ?>
										<?php } ?>
										<?php if($Permissions->can('SHOW_TICKETS_ANWSERS')) { ?>
									    	<p><button id="<?= $value['Ticket']['id'] ?>" title="<?= $Lang->get('SHOW_ANSWER') ?>" class="btn btn-info btn-sm dropdown_reply"><icon style="font-size: 10px;" class="fa fa-chevron-down"></icon></button></p>
									    <?php } ?>
									    <?php if($value['Ticket']['state'] == 0 AND $this->Connect->connect() AND $this->Connect->if_admin() OR $this->Connect->connect() AND $this->Connect->get_pseudo() == $value['Ticket']['author'] AND $value['Ticket']['state'] == 0 AND $Permissions->can('REPLY_TO_HIS_TICKETS') OR $Permissions->can('REPLY_TO_ALL_TICKETS')) { ?>
									    <p><button id="<?= $value['Ticket']['id'] ?>" title="<?= $Lang->get('REPLY') ?>" class="btn btn-warning btn-sm ticket-reply"><icon class="fa fa-mail-reply" style="font-size: 10px;"></icon></button></p>
										<?php } ?>
									</div>
								    <p class="support"><?= $value['Ticket']['content'] ?></p>
								  </div>
								</div>
								<div class="reply reply_<?= $value['Ticket']['id'] ?>">
									<!-- Une réponse --> 
									<?php if($Permissions->can('SHOW_TICKETS_ANWSERS')) { ?>
										<?php foreach ($reply_tickets as $k => $v) { ?>
											<?php if($v['ReplyTicket']['ticket_id'] == $value['Ticket']['id']) { ?>
											<div id="ticket-reply-<?= $v['ReplyTicket']['id'] ?>">
												<div class="line-support"></div>
												<div class="col-md-11 reply-col">
													<div class="panel panel-default">
													  <div class="panel-body">
													    <img class="support" src="<?= $this->Html->url(array('controller' => 'API', 'action' => 'get_head_skin/')) ?>/<?= $v['ReplyTicket']['author']; ?>/50" title="<?= $v['ReplyTicket']['author']; ?>">
													    <?php if($this->Connect->connect() AND $this->Connect->if_admin()) { ?>
													    <div class="pull-right">
														    <p><button id="<?= $v['ReplyTicket']['id'] ?>" title="<?= $Lang->get('DELETE') ?>" class="btn btn-danger btn-sm reply-delete"><icon class="fa fa-times"></icon></button></p>
														</div>
														<?php } ?>
													    <p class="support"><?= $v['ReplyTicket']['reply']; ?></p>
													  </div>
													</div>
												</div>
											</div>
											<?php } ?>
										<?php } ?>
									<?php } ?>
									<!-- - - - - -->
								</div>
							</div>
							<!-- - - - - -->
						<?php } ?>
					<?php } ?>
				<?php } else { echo $Lang->get('NO_TICKETS'); } ?>
			</div>
			<div class="col-md-3 hidden-xs hidden-sm">
                <div class="well">
                    <h4><?= $Lang->get('STATS') ?></h4>
                    <p><b><?= $Lang->get('NUMBER_OF_TICKETS') ?> : </b><span id="nbr-ticket"><?= $nbr_tickets ?></span></p>
                    <p><b><?= $Lang->get('NUMBER_OF_RESOLVED') ?> : </b><span id="nbr-ticket-resolved"><?= $nbr_tickets_resolved ?></span></p>
                    <p><b><?= $Lang->get('NUMBER_OF_UNRESOLVED') ?> : </b><span id="nbr-ticket-unresolved"><?= $nbr_tickets_unresolved ?></span></p>
                </div>
                <?php if($this->Connect->connect() AND $Permissions->can('POST_TICKET')) { ?>
                	<a href="#" data-toggle="modal" data-target="#post_ticket" class="btn btn-success btn-lg btn-block"><icon class="fa fa-pencil-square-o"></icon> <?= $Lang->get('POST_A_TICKET') ?></a>
                <?php } ?>
            </div> 
		</div>
    </div>

    <div class="modal fade" id="post_ticket" tabindex="-1" role="dialog" aria-labelledby="post_ticketLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $Lang->get('CLOSE') ?></span></button>
            <h4 class="modal-title" id="myModalLabel"><?= $Lang->get('POST_A_TICKET') ?></h4>
          </div>
          <div class="modal-body">
          	<div id="msg-on-post"></div>
          	<form id="ticket-form_post" method="post" class="form-horizontal">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><?= $Lang->get('TITLE') ?></label>
			    <div class="col-sm-10">
			      <input type="text" name="title" class="form-control" id="inputEmail3" placeholder="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"><?= $Lang->get('PROBLEM') ?></label>
			    <div class="col-sm-10">
			      <textarea name="content" class="form-control" rows="3"></textarea>
			    </div>
			  </div>
			  <div class="checkbox">
			    <label>
			      <input id="private" name="private" type="checkbox"> <?= $Lang->get('PRIVATE_TICKET') ?>
			    </label>
			  </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default"><?= $Lang->get('CLOSE') ?></button>
            <button type="submit" class="btn btn-primary"><?= $Lang->get('SUBMIT') ?></button>
        </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="reply_ticket" tabindex="-1" role="dialog" aria-labelledby="reply_ticketLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $Lang->get('CLOSE') ?></span></button>
            <h4 class="modal-title" id="myModalLabel"><?= $Lang->get('REPLY_TO_TICKET') ?></h4>
          </div>
          <div class="modal-body">
          	<div id="msg-on-reply"></div>
          	<div class="ticket-reply">Javascript désactiver ?</div>
          	<div style="margin-right:490px;" class="line-support"></div>
          	<form class="form-horizontal" id="ticket-form_reply" method="post" role="form">
          		<input id="id_reply_form" type="hidden" name="id" value="ID">
          		<textarea name="reply" class="form-control" rows="3" placeholder="<?= $Lang->get('YOUR_REPLY') ?>"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default"><?= $Lang->get('CLOSE') ?></button>
            <button type="submit" class="btn btn-primary"><?= $Lang->get('SUBMIT') ?></button>
           </form>
          </div>
        </div>
      </div>
    </div>
