import ListItem from "@mui/material/ListItem";
import ListItemText from "@mui/material/ListItemText";
import React, { FC } from "react";

interface IListProductSideBarItemCategoryItemChildren {
  name: string;
}

const ListProductSideBarItemCategoryItemChildren: FC<
  IListProductSideBarItemCategoryItemChildren
> = (props) => {
  const { name } = props;

  return (
    <ListItem disablePadding className="py-1.5">
      <ListItemText>
        <span className="text-sm text-color-gray">{name}</span>
      </ListItemText>
    </ListItem>
  );
};

export default ListProductSideBarItemCategoryItemChildren;
