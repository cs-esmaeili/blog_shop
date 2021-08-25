import statics from "../../statics.json";
import { Image } from "react-bootstrap";
import { FaGoogle } from 'react-icons/fa';

const Sidebar = () => {


    return (
        <div className='sidebar-container vh-100'>
            <div className='sidebar-title'>
                نیک آفرین
            </div>
            <div className='sidebar-content'>
                <div className='sidebar-image'>
                    <Image
                        className="mb-4"
                        src={statics.logo_url}
                        rounded
                        fluid
                        style={{ width: "300px" }}
                    />
                </div>
                <div className='sidebar-item sidebar-item-title'>
                    <span>خانه</span>
                </div>
                <div className='sidebar-item'>
                    <span>
                        بازدید سایت
                    </span>
                    <FaGoogle />
                </div>
                <i class="fas fa-angle-left"></i>
            </div>
        </div>
    );
}

export default Sidebar;
