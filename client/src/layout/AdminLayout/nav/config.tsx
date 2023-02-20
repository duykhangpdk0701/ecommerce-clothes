// component
import SvgColor from "@/components/shared/svg-color";

// ----------------------------------------------------------------------

const icon = (name: string) => (
  <SvgColor
    src={`/assets/icons/navbar/${name}.svg`}
    sx={{ width: 1, height: 1 }}
  />
);

export interface INavConfig {
  title: string;
  path: string;
  icon: JSX.Element;
}

const navConfig: INavConfig[] = [
  {
    title: "dashboard",
    path: "/admin",
    icon: icon("ic_analytics"),
  },
  { title: "Brand", path: "/admin/brand", icon: icon("ic_user") },
  {
    title: "user",
    path: "/admin/user",
    icon: icon("ic_user"),
  },
  {
    title: "product",
    path: "/admin/products",
    icon: icon("ic_cart"),
  },
  {
    title: "Category",
    path: "/admin/category",
    icon: icon("ic_cart"),
  },
  {
    title: "Item Color",
    path: "/admin/item-color",
    icon: icon("ic_cart"),
  },
  {
    title: "Item Size",
    path: "/admin/item-size",
    icon: icon("ic_cart"),
  },
  {
    title: "blog",
    path: "/admin/blog",
    icon: icon("ic_blog"),
  },

  {
    title: "Not found",
    path: "/404",
    icon: icon("ic_disabled"),
  },
];

export default navConfig;
