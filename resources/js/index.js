import {useState, useEffect} from 'react';
import {
  BrowserRouter as Router,
  Switch,
  Route  
} from "react-router-dom";
import AOS from "aos";



import Navbar from "./components/Navbar";
import Beranda from "./pages/Beranda";
import Bidang from "./pages/Bidang";


// Style
import '../sass/style.scss';
import "aos/dist/aos.css";
import Informasi from './pages/Informasi';
import InformasiDetail from './pages/InformasiDetail';
import NotFound from './pages/Not_Found';

// 0 Light
// 1 Dark

function App() {
  const [nav, setNav] = useState(true);
  const [bg, setBg] = useState(false);

  const handleSectionChange = (section) => {
    if(section===0){
      setNav(true)
    }else{
      setNav(false)
    }
  }

  useEffect(() => {
    AOS.init();
  }, []);
  
  return (
    <>
    <Router>      
      <Navbar isDark={nav} bgWhite={bg}/>
      <Switch>
        <Route path="/" exact>
          <Beranda sectionActive={handleSectionChange} />
        </Route>
        <Route path="/bidang" exact>          
          <Bidang sectionActive={handleSectionChange}/>
        </Route>
        <Route path="/informasi" exact>          
          <Informasi sectionActive={handleSectionChange} navbgWhite={(con)=>setBg(con)} />          
        </Route>
        <Route path="/informasi-detail/:slug" >          
          <InformasiDetail sectionActive={handleSectionChange} navbgWhite={(con)=>setBg(con)} />          
        </Route>
        <Route>
          <NotFound sectionActive={handleSectionChange}/>
        </Route>
      </Switch>
    </Router>
    </>
  );
}

export default App;
