import statics from "../../statics.json";
import { Image } from "react-bootstrap";
import { FaGoogle, FaAngleLeft, FaAngleDown } from 'react-icons/fa';
import Collaps from '../components/Collaps';

const Sidebar = () => {
    return (
        <div className='sidebar-container'>
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


                <Collaps className='sidebar-item' indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                        <div>خانه _</div>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />

                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />

                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    بازدید سایت
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
                <Collaps indexData={(status) => {
                    return (
                        <div className='sidebar-item'>
                            {status ? <FaAngleDown /> : <FaAngleLeft />}

                            <div>
                                <span>
                                    WWAW
                                </span>
                                <FaGoogle />
                            </div>

                        </div>
                    )
                }} colllapsData={
                    <div className='sidebar-list'>
                        <div>خانه _</div>
                    </div>
                } />
            </div>
        </div>
    );
}

export default Sidebar;
