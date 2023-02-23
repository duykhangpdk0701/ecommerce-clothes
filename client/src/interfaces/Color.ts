interface IColor {
  id: number;
  name: string;
}

export interface IAdminColor extends IColor {
  status: boolean;
}

export default IColor;
