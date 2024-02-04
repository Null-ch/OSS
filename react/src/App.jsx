import React from "react";
import './styles/reset.css'
import Layout from "./components/Layout";
import {publicRoutes} from './routes'
import {Route, Routes} from 'react-router-dom'

function App() {
  return (
    <>
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
    </>
  );
}

export default App;
