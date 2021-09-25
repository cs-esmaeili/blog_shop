import Sidebar from "./Sidebar";
import Header from "./Header";
import Content from "./Content";
import { useMediaQuery } from 'react-responsive';
import { useState } from "react";

const Main = () => {

    const isMobile = useMediaQuery({ query: '(min-width: 576px)' });
    const [status, setStatus] = useState(true);

    return (
        <div className='d-flex flex-row flex-nowrap'>
            <div className='main-content-container flex-grow-1'>
                <Header changeStatus={() => setStatus(!status)} />
                <Content />
            </div>
            <div className='sidebar' style={{ marginRight: isMobile ? '0px' : (status * -200) + 'px' }}>
                <Sidebar />
            </div>
        </div>
    );
}

export default Main;
