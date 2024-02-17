import React, {useEffect, useState} from "react";
import './styles/reset.css'
import Layout from "./components/Layout";
import {publicRoutes} from './routes'
import {Route, Routes, BrowserRouter} from 'react-router-dom'
import { Context } from "./utils/context";
import Header from './components/header/Header';
import Footer from './components/footer/Footer';

function App() {

  const isLogged = localStorage.getItem('isLoggedIn')
  const [loggedIn, setLoggedIn] = useState(isLogged);

  const logIn = () => {
    localStorage.setItem('isLoggedIn', JSON.stringify(true))
    setLoggedIn(true)
  }

  const logOut = () => {
    localStorage.setItem('isLoggedIn', JSON.stringify(false))
    setLoggedIn(false)
  }

  // console.log(isLogged)

  return (
    <>
      <Context.Provider value = {{
        logIn, logOut
      }}>
        <BrowserRouter>
          {/* {isLogged === 'true' ? <span>Залогинился</span> : <span>Разлогинился</span>} */}
          <Header/>

          <Routes>
            <Route path = "/" element = {<Layout/>}>
              {/* Layout = обёртка с хедером, футером и т.д, Outlet = Контент внутри обёртки */}
              {publicRoutes.map(({path, component}) =>
              {
                if (path === "/") {
                  return <Route key = {path} index element = {component} exact/>
                } else {
                  return <Route key = {path} path = {path} element = {component} exact/>
                }
              }    
              )}
            </Route>
          </Routes>

          <Footer/>

        </BrowserRouter>
      </Context.Provider>
    </>
  );
}

export default App;
