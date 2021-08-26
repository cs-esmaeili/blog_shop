import Sidebar from "./Sidebar";
import Header from "./Header";
import Content from "./Content";

const Main = () => {
    return (
        <div className='d-flex flex-row flex-nowrap'>
            <div className='main-content-container flex-grow-1'>
                <Header />
                <Content />
            </div>
            <div style={{ backgroundColor: "red" }}>
                <Sidebar />
            </div>
        </div>
    );
}

export default Main;
