import List from "@mui/material/List";
import ICategory from "@/interfaces/Category";
import React, { FC, Fragment } from "react";
import ListProductSideBarItemCategoryItem from "./item";
import ListProductSideBarItemCategoryItemChildren from "./itemChildren";

interface IListProductSideBarItemCategory {
  data?: ICategory[];
}

const ListProductSideBarItemCategory: FC<IListProductSideBarItemCategory> = (
  props
) => {
  const { data } = props;
  return (
    <>
      <h6 className="text-sm font-semibold mb-2.5">Categories</h6>
      <List disablePadding>
        {data?.map((item) =>
          item.children ? (
            <Fragment key={item.id}>
              <ListProductSideBarItemCategoryItem data={item} />
            </Fragment>
          ) : (
            <Fragment key={item.id}>
              <ListProductSideBarItemCategoryItemChildren
                name={item.name.en}
                id={item.id}
              />
            </Fragment>
          )
        )}
      </List>
    </>
  );
};

export default ListProductSideBarItemCategory;
