<?php
echo "<div class='post' id='first'>";
echo anchor('pages/create', '<p>+ New Group</p>');
echo '</div>';
foreach ($query->result() as $row) {
    $edit_url = base_url().'confessions/'.$row->id;
    echo "<div class='post'><h2><a class='red' href='/app/confessions/view/".$row->id."'>".$row->name."</a></h2></div>";
}
?>
