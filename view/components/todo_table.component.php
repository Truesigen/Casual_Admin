                   
                        <tr>
                        <td><?= $event->id ?></td>
                        <td><?= $event->header ?></td>
                        <td><?= $event->description?></td>
                        <td><?= $event->created_at?></td>
                        <td><?= $event->name?></td>
                        <td><?php if (empty($_SESSION['user_id'])) { ?>
                            <a href="/login" class="templatemo-blue-button">Login</a> 
                       <?php } else {?>
                             <a href="/event/?id=<?=$event->id?>" class="templatemo-white-button">Catch up</a>
                        <?php } ?>
                        </td>
                        </tr>

                        