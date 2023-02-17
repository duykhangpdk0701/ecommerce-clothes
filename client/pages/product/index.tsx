//api
import brandAPI from "@/api/brandAPI";
import categoryAPI from "@/api/categoryAPI";
//component
import ListProductTemplate from "@/components/templates/product/listProduct";
import ListProductProducts from "@/components/templates/product/listProduct/products";
import ListProductSideBar from "@/components/templates/product/listProduct/sideBar";
import ListProductdSideBarBrand from "@/components/templates/product/listProduct/sideBar/brand";
import ListProductSideBarItemCategory from "@/components/templates/product/listProduct/sideBar/category";
import ListProductSortBar from "@/components/templates/product/listProduct/sortBar";
//layout
import HomeLayout from "@/layout/HomeLayout";
//nextjs
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const Product = () => {
  const itemCategoryQuery = useQuery(
    "item-category",
    categoryAPI.getListOfCategory
  );

  const brandQuery = useQuery("brand", brandAPI.getListOfBrand);

  return (
    <>
      <Head>
        <title>Product | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListProductTemplate
        listProductSortBar={<ListProductSortBar />}
        listProductSideBar={
          <ListProductSideBar
            listProductSideBarItemCategory={
              <ListProductSideBarItemCategory data={itemCategoryQuery.data} />
            }
            listProductSideBarBrand={
              <ListProductdSideBarBrand data={brandQuery.data} />
            }
          />
        }
        listProductProducts={<ListProductProducts />}
      />
      ;
    </>
  );
};

Product.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Product;
