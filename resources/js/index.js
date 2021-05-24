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
import Login from "./pages/Login";

// Style
import '../sass/style.scss';
import "aos/dist/aos.css";

// 0 Light
// 1 Dark

function App() {
  useEffect(() => {
    AOS.init();
  }, []);
  const [nav, setNav] = useState(true);
  const handleSectionChange = (section) => {
    if(section===0){
      setNav(true)
    }else{
      setNav(false)
    }
  }
  
  return (
    <>
    <Router>      
      <Navbar isDark={nav}/>
      <Switch>
        <Route path="/" exact>
          <Beranda sectionActive={handleSectionChange} />
        </Route>
        <Route path="/bidang" exact>          
          <Bidang sectionActive={handleSectionChange}/>
        </Route>
        <Route path="/login" exact>
          <Login sectionActive={handleSectionChange}/>
        </Route>
      </Switch>
    </Router>
    </>
  );
}

export default App;
