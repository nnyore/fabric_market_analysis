#ec2 instance for public subnet
resource "aws_instance" "public-ec2" {
  ami                    = "ami-0905a3c97561e0b69"
  instance_type          = "t2.micro"
  subnet_id              = aws_subnet.publicsubnet.id
  vpc_security_group_ids = [aws_security_group.allow_traffic.id]
  key_name               = aws_key_pair.terrakey.key_name

  tags = {
    Name = "fabric-public-ec2"
  }

}

resource "aws_instance" "public-ec22" {
  ami                    = "ami-0905a3c97561e0b69"
  instance_type          = "t2.micro"
  subnet_id              = aws_subnet.publicsubnet.id
  vpc_security_group_ids = [aws_security_group.allow_traffic.id]
  key_name               = aws_key_pair.terrakey.key_name

  provisioner "file" {
    source      = "setup_mongodb.sh"
    destination = "/tmp/setup_mongodb.sh"
  }

  provisioner "remote-exec" {
    inline = [
      "chmod +x /tmp/setup_mongodb.sh",
      "sudo /tmp/setup_mongodb.sh"
    ]
  }

  connection {
    type        = "ssh"
    user        = "ubuntu"
    private_key = file(var.PATH_TO_PRIVATE_KEY)  # Update with your private key path
    host        = self.public_ip
  }


  tags = {
    Name = "public-ec2"
  }

}

output "instance_ip" {
  value = aws_instance.public-ec22.public_ip
}