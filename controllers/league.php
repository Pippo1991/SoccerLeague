<?
require_once('helpers/__country.php');
require_once('helpers/__league.php');
$this->data['menu']='league';
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->admin = new Admin($_SESSION['SL_account']);
$this->isAdmin=$this->admin->isAdmin();

$division = $this->request['div'] ?? $_SESSION['SL_div'];
$group = $this->request['group'] ?? $_SESSION['SL_group'];
$country = strtoupper($this->request['country']) ?? strtoupper($_SESSION['SL_country']);


if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: http://'.$_SERVER['SERVER_NAME'].'/league/'.strtolower($_SESSION['SL_country']).'/'.$division.'/'.$group);

if(isset($this->request['request']) AND !isset($this->request['subrequest'])){
  $this->addCSSFile('league.css');
  $league =  new League(getCountryID($country), SEASON, $division, $group);

  $this->data['leagueName']=$league->name;
  $this->data['title']=$league->name;
  $this->data['division']=$division;
  $this->data['group']=$group;

  $query=$league->getLeagueTable();

  $i=0;
  while($data=$query->fetch()){
    $this->data['leagueTable'][$i]=$data;
    if($_SESSION['SL_club']==$data['id_club']){
      $this->data['leagueTable'][$i]['class']='selected';
    }else{
      $this->data['leagueTable'][$i]['class']='';
    }
    $this->data['leagueTable'][$i]['status']=__leagueStatus($division,$i+1);
    $this->data['leagueTable'][$i]['country']=flag(getCountryByID(Club::getClubCountryById($data['id_club'])));
    $i++;
  }
  $leagueFixture = new LeagueFixture($league->id_league);
  $leagueFixture->getNextLeagueDay();
  $leagueMatches=$leagueFixture->getFixtures();
  $this->data['round']=$leagueFixture->next_round;
  foreach ($leagueMatches as $id_match) {
    $match = new MatchReport($id_match);
    $this->data['matches'][$id_match]=$match->teams();
    $this->data['matches'][$id_match]['homeTeam']=Club::getClubNameById($this->data['matches'][$id_match]['home']);
    $this->data['matches'][$id_match]['awayTeam']=Club::getClubNameById($this->data['matches'][$id_match]['away']);
  }
}else{
  switch ($this->request['subrequest']) {
    case 'calendar':
      $this->addJSFile('leagueCalendar.js');
      $league =  new League(getCountryID($country), SEASON, $division, $group);

      $this->data['leagueName']=$league->name;
      $this->data['title']=$league->name;
      $this->data['division']=$division;
      $this->data['group']=$group;
      $this->data['country']=flag(strtolower($country));

      $months = LeagueFixture::getMatchDays();
      foreach ($months as $key => $date){
        $leagueFixture = new LeagueFixture($league->id_league,$date);
        $leagueFixture->getNextLeagueDay();
        foreach($leagueFixture->getFixtures() as $key => $id_match){
          $match = new MatchReport($id_match);
          $this->data['matches'][$id_match]=$match->teams();
          $this->data['matches'][$id_match]['match']=$id_match;
          $this->data['matches'][$id_match]['date']=$date;
          $this->data['matches'][$id_match]['homeTeam']=Club::getClubNameById($this->data['matches'][$id_match]['home']);
          $this->data['matches'][$id_match]['awayTeam']=Club::getClubNameById($this->data['matches'][$id_match]['away']);
        }
      }


      $this->requestURL='leaguecalendar';
      break;
  }
}
