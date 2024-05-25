import React, {Suspense, useEffect, useState} from "react";
import './styles/reset.css'
import './styles/common.css'
import Layout from "./components/Layout";
import {publicRoutes} from './routes'
import {Route, Routes, useLocation} from 'react-router-dom'
import Header from './components/header/Header.jsx';
import Footer from './components/footer/Footer';
import Modal from "./components/modal/Modal";
import { setIsModalVisible, setModalData, setContent } from './store/modalSlice';
import { useDispatch, useSelector } from 'react-redux';
import NotFound from "./pages/util/NotFound.jsx";

function App() {
  // const isLogged = localStorage.getItem('isLoggedIn');
  // const [loggedIn, setLoggedIn] = useState(isLogged);

  // const logIn = () => {
  //   localStorage.setItem('isLoggedIn', JSON.stringify(true));
  //   setLoggedIn(true);
  // }

  // const logOut = () => {
  //   localStorage.setItem('isLoggedIn', JSON.stringify(false));
  //   setLoggedIn(false);
  // }

  const location = useLocation();
  useEffect(() => {
      dispatch(setIsModalVisible(false));
  }, [location]);

  const dispatch = useDispatch();
  const {isModalVisible, content} = useSelector((state) => state.modal);

  window.onscroll = function() { scrollFunction() };

  function scrollFunction() {
    // if (document.body.scrollTop > 24 || document.documentElement.scrollTop > 24) {
    //   document.getElementById("header").className = 'header-fixed';
    // } else {
    //   document.getElementById("header").className = 'header';
    // }
  }
  
  // window.localStorage.clear();

  return (
    <>
      <Header/>

      <Routes>
        <Route path = "/" element = {<Layout/>}>
          {publicRoutes.map(({path, component}) =>
          {
            const element = <Suspense>{component}</Suspense>
            if (path === "/") {
              return <Route key = {path} index element = {element} exact/>
            } else {
              return <Route key = {path} path = {path} element = {element} exact/>
            }
          }    
          )}
        </Route>
        <Route path = "*" element = {<NotFound/>}/>
      </Routes>

      <Footer/>

      <Modal
            isActive = {isModalVisible}
            content = {content}
            onClose={() => {
              dispatch(setIsModalVisible(false));
            }}
        />
    </>
  );
}

export default App;
