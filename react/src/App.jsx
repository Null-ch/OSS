import React, {useEffect, useState} from "react";
import './styles/reset.css'
import './styles/common.css'
import Layout from "./components/Layout";
import {publicRoutes} from './routes'
import {Route, Routes, BrowserRouter} from 'react-router-dom'
import Header from './components/header/Header';
import Footer from './components/footer/Footer';
import Modal from "./components/modal/Modal";
import { setIsModalVisible, setModalData, setContent } from './store/modalSlice';
import { useDispatch, useSelector } from 'react-redux';

function App() {

  const isLogged = localStorage.getItem('isLoggedIn');
  // const [loggedIn, setLoggedIn] = useState(isLogged);

  // const logIn = () => {
  //   localStorage.setItem('isLoggedIn', JSON.stringify(true));
  //   setLoggedIn(true);
  // }

  // const logOut = () => {
  //   localStorage.setItem('isLoggedIn', JSON.stringify(false));
  //   setLoggedIn(false);
  // }

  const dispatch = useDispatch();
  const {isModalVisible, content} = useSelector((state) => state.modal);

  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 24 || document.documentElement.scrollTop > 24) {
      document.getElementById("header").className = 'header-fixed';
    } else {
      document.getElementById("header").className = 'header';
    }
  }

  return (
    <>
      {/* <Context.Provider value = {{
        logIn, logOut
      }}> */}
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

          <Modal
                isActive = {isModalVisible}
                content = {content}
                onClose={() => {
                    dispatch(setIsModalVisible(false));
                }}
            />

        </BrowserRouter>
      {/* </Context.Provider> */}
    </>
  );
}

export default App;
