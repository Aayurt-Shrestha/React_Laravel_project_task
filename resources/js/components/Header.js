import React from 'react'
    import { Link } from 'react-router-dom'

    const Header = () => (
      <nav className='navbar navbar-expand-md navbar-light navbar-laravel'>
        <div className='container'>
          <Link className='navbar-brand' to='/'>Taskssman</Link>
        </div>
      </nav>
    )
//We are making use of the Link component from React Router.
// This will prevent our page from refreshing whenever we navigate around our app.
export default Header