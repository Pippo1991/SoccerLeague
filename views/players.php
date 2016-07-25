<?
require_once('helpers/__skill.php');
?>
<main>
  <div class='content'>
    <h3 class='title'><?=$this->data['clubname']?></h3>
    <div class='grid-100'>
      <div class='box'>
        <div class='box-title'>Jogadores</div>
        <div class='box-content'>
          <table class='zebra bordered'>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Posição</th>
                <th>Idade</th>
                <th>For</th>
                <th>Vel</th>
                <th>Res</th>
                <th>Sal</th>
                <th>Emp</th>
                <th>Pos</th>
                <th>Con</th>
                <th>Dec</th>
                <th>Vis</th>
                <th>Imp</th>
                <th>Com</th>
                <th>Mar</th>
                <th>Des</th>
                <th>Cru</th>
                <th>Pas</th>
                <th>Tec</th>
                <th>B.Con</th>
                <th>Dri</th>
                <th>Lon</th>
                <th>Fin</th>
                <th>Cab</th>
              </tr>
            </thead>
            <tbody>
              <?
              for($i=0;$i<count($this->data['playersTable']['line']);$i++){?>
                <tr class='center'>
                  <td class='left'><?=$this->data['playersTable']['line'][$i]['name'];?></td>
                  <td class='border'><?=$this->data['playersTable']['line'][$i]['position'];?></td>
                  <td class='border'><?=$this->data['playersTable']['line'][$i]['age'];?></td>
                  <td class=''><?=__skill($this->data['playersTable']['line'][$i]['stamina']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['speed']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['resistance']);?></td>
                  <td class='border'><?=__skill($this->data['playersTable']['line'][$i]['jump']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['workrate']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['positioning']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['concentration']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['decision']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['vision']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['unpredictability']);?></td>
                  <td class='border'><?=__skill($this->data['playersTable']['line'][$i]['communication']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['marking']);?></td>
                  <td class='border'><?=__skill($this->data['playersTable']['line'][$i]['tackling']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['crossing']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['pass']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['technical']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['ballcontrol']);?></td>
                  <td class='border'><?=__skill($this->data['playersTable']['line'][$i]['dribble']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['longshot']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['finish']);?></td>
                  <td><?=__skill($this->data['playersTable']['line'][$i]['heading']);?></td>
                </tr>
              <? } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class='box'>
        <div class='box-title'>Goleiros</div>
        <div class='box-content'>

        </div>
      </div>
    </div>
  </div>
</main>
