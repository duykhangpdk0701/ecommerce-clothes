//mui component
import Divider from "@mui/material/Divider";
import Paper from "@mui/material/Paper";
import React, { FC, ReactNode } from "react";
import ListProductdSideBarBrand from "./brand";

interface IListProductSideBar {
  listProductSideBarItemCategory: ReactNode;
  listProductSideBarBrand: ReactNode;
  listProudctSideBarPersonType: ReactNode;
  listProductSideBarItemColor: ReactNode;
  listProductSideBarItemSize: ReactNode;
}

const ListProductSideBar: FC<IListProductSideBar> = (props) => {
  const {
    listProductSideBarItemCategory,
    listProductSideBarBrand,
    listProudctSideBarPersonType,
    listProductSideBarItemColor,
    listProductSideBarItemSize,
  } = props;
  return (
    <Paper className="w-full py-4 px-7">
      {listProductSideBarItemCategory}
      <Divider className="border-[#F3F5F9] my-6" />
      {listProductSideBarBrand}
      <Divider className="border-[#F3F5F9] my-6" />
      {listProudctSideBarPersonType}
      <Divider className="border-[#F3F5F9] my-6" />
      {listProductSideBarItemSize}
      <Divider className="border-[#F3F5F9] my-6" />
      {listProductSideBarItemColor}
    </Paper>
  );
};

export default ListProductSideBar;
